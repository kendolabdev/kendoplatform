<?php
namespace Mail\Service;

use Mail\Model\MailTemplate;
use Kendo\Exception;

/**
 * Class MailService
 *
 * @package Core\Service
 */
class MailService
{

    /**
     * @param $name
     *
     * @return \Core\Model\MailTemplate
     */
    public function findTemplateByName($name)
    {
        return \App::table('mail.mail_template')
            ->select()
            ->where('template_name=?', (string)$name)
            ->one();
    }


    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminTemplatePaging($query = [], $page = 1, $limit = 100)
    {

        $select = \App::table('mail.mail_template')
            ->select();

        if (!empty($query['module']))
            $select->where('module_name=?', (string)$query['module']);

        $select->where('module_name in?', \App::extensions()->getActiveModuleNames());

        return $select->paging($page, $limit);
    }

    /**
     * @param array $query
     * @param int   $page
     * @param int   $limit
     *
     * @return \Kendo\Paging\PagingInterface
     */
    public function loadAdminTransportPaging($query = [], $page = 1, $limit = 100)
    {
        $select = \App::table('mail.mail_adapter')->select();

        if (!empty($query)) ; // do nothing with query

        return $select->paging($page, $limit);
    }


    /**
     * Be careful, data does not validate.
     *
     * @param int    $templateId
     * @param string $languageId
     * @param string $subject
     * @param string $bodyText
     * @param string $bodyHtml
     *
     * @return MailTemplate
     */
    public function createMailTranslate($templateId, $languageId, $subject, $bodyText, $bodyHtml)
    {
        $translate = new MailTemplate([
            'template_id' => $templateId,
            'language_id' => $languageId,
            'subject'     => $subject,
            'body_text'   => $bodyText,
            'body_html'   => $bodyHtml,
        ]);

        $translate->save();

        return $translate;
    }

    /**
     * @param $name
     * @param $languageId
     *
     * @return MailTemplate
     * @throws Exception
     */
    public function getMailTranslate($name, $languageId)
    {
        $template = $this->findTemplateByName($name);

        if (!$template) {
            throw new Exception("Mail [$name] does not exists");
        }


        $translate = \App::table('mail.mail_translate')
            ->select()
            ->where('template_id=?', $template->getId())
            ->where('language_id=?', (string)$languageId)
            ->one();

        if ($translate) {
            return $translate;
        }

        if (false == \App::service('mail.language')->hasLanguage($languageId)) {
            throw new Exception("Language [$languageId] does not support.");
        }

        return $this->createMailTranslate(
            $template->getId(),
            $languageId,
            $template->getSubjectDefault(),
            $template->getBodyTextDefault(),
            $template->getBodyTextDefault());

    }

    /**
     * @param string $name Template name
     * @param string $languageId
     *
     * @return array  [subject: string, body_text: string, body_html: string, module_name: string, template_name:
     *                string, template_id: int]
     */
    public function getTemplate($name, $languageId)
    {
        $row = \App::table('mail.mail_translate')
            ->select('trans')
            ->rightJoin(':mail_template', 'tpl', 'trans.template_id=trans.template_id AND trans.language_id=:languageId', [':languageId' => $languageId], null)
            ->where('tpl.template_name=?', $name)
            ->toAssoc();

        $maps = [
            'subject_default'   => 'subject',
            'body_text_default' => 'body_text',
            'body_html_default' => 'body_html',
        ];

        $response = [
            'template_id'   => $row['template_id'],
            'template_name' => $row['template_name'],
            'module_name'   => $row['module_name'],
        ];

        foreach ($maps as $key1 => $key2) {
            $response[ $key2 ] = !empty($row[ $key2 ]) ? $row[ $key2 ] : $row[ $key1 ];
        }

        return $response;
    }

    /**
     * @param string $name
     * @param array  $data [subject, body_text, body_html]
     *
     * @throws Exception
     */
    public function setDefaultTemplate($name, $data)
    {
        $template = $this->findTemplateByName($name);

        if (!$template) {
            throw new Exception("Could not find email template [$name]");
        }

        $template->setFromArray([
            'subject_default'   => $data['subject'],
            'body_text_default' => $data['body_text'],
            'body_html_default' => $data['body_html'],
        ]);

        $template->save();
    }

    /**
     * @param $name
     * @param $languageId
     * @param $data
     *
     * @return bool
     * @throws Exception
     */
    public function setTemplate($name, $languageId, $data)
    {
        $mailEntry = $this->getMailTranslate($name, $languageId);

        unset($data['language_id'], $data['template_id']);

        $mailEntry->setFromArray($data);

        $mailEntry->save();

        return true;
    }


    /**
     * @param array $moduleList
     *
     * @return array
     */
    public function getListTemplateByModuleName($moduleList = [])
    {
        return \App::table('mail.mail_template')
            ->select()
            ->where('module_name IN ?', $moduleList)
            ->toAssocs();
    }
}