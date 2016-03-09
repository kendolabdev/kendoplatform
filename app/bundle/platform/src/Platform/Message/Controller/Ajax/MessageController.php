<?php

namespace Platform\Message\Controller\Ajax;

use Kendo\Content\PosterInterface;
use Kendo\Controller\AjaxController;

/**
 * Class MessageController
 *
 * @package Message\Controller\Ajax
 */
class MessageController extends AjaxController
{


    public function actionCompose()
    {
        $form = app()->html()->factory('\Message\Form\ComposeMessage');

        $recipient = null;

        $poster = app()->auth()->getViewer();

        if ($this->request->isMethod('post')&& empty($_POST['send'])) {

            $values = [];

            $id = $this->request->getString('id');
            $type = $this->request->getString('type');

            if (!empty($type) && !empty($id)) {
                $recipient = app()->find($type, $id);
                if ($recipient instanceof PosterInterface) {
                    $values['recipients'][] = $recipient->getId() . '@' . $recipient->getType();
                }
            }
            $form->setData($values);
        }

        $messageService = app()->messageService();


        if ($this->request->isMethod('post')&& !empty($_POST['send']) && $form->isValid($_POST)) {

            $data = $form->getData();

            $subject = $data['subject'];
            $content = $data['content'];

            $recipients = $data['recipients'];

            if (empty($recipients)) {
                $form->setErrors('Add recipient');
            }

            $users = [];

            /**
             * validate receivers
             */
            foreach ($recipients as $recipient) {
                list($rid, $rtype) = explode('@', $recipient);
                $user = app()->find($rtype, $rid);

                if (!null == $user && $user instanceof PosterInterface) {
                    $users[] = $user;
                }
                /**
                 * TODO: check permission to send message if needed. fail from follow
                 */
            }

            $messageService->addMessage($poster, $users, $subject, $content);

            app()->routing()->redirect('message_inbox');

        }

        $this->response['html'] = app()->viewHelper()->partial('/base/message/controller/ajax/compose-message', [
            'form' => $form,
        ]);
    }

    /**
     *
     */
    public function actionBearDialog()
    {
        $viewer = app()->auth()->getViewer();

        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = app()->messageService()
            ->loadMessagePaging($query, $page);

        $lp = app()->layouts()
            ->getContentLayoutParams('message_ajax_bear_dialog');

        $this->response = [
            'html' => $this->partial($lp->script(), [
                'pagingUrl' => 'ajax/platform/message/message/paging',
                'profile'   => $viewer,
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ])
        ];
    }
}