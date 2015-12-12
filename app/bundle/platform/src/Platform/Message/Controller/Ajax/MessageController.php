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
        $form = \App::htmlService()->factory('\Message\Form\ComposeMessage');

        $recipient = null;

        $poster = \App::authService()->getViewer();

        if ($this->request->isPost() && empty($_POST['send'])) {

            $values = [];

            $id = $this->request->getString('id');
            $type = $this->request->getString('type');

            if (!empty($type) && !empty($id)) {
                $recipient = \App::find($type, $id);
                if ($recipient instanceof PosterInterface) {
                    $values['recipients'][] = $recipient->getId() . '@' . $recipient->getType();
                }
            }
            $form->setData($values);
        }

        $messageService = \App::messageService();


        if ($this->request->isPost() && !empty($_POST['send']) && $form->isValid($_POST)) {

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
                $user = \App::find($rtype, $rid);

                if (!null == $user && $user instanceof PosterInterface) {
                    $users[] = $user;
                }
                /**
                 * TODO: check permission to send message if needed. fail from follow
                 */
            }

            $messageService->addMessage($poster, $users, $subject, $content);

            \App::routingService()->redirect('message_inbox');

        }

        $this->response['html'] = \App::viewHelper()->partial('/base/message/controller/ajax/compose-message', [
            'form' => $form,
        ]);
    }

    /**
     *
     */
    public function actionBearDialog()
    {
        $viewer = \App::authService()->getViewer();

        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = \App::messageService()
            ->loadMessagePaging($query, $page);

        $lp = \App::layoutService()
            ->getContentLayoutParams('message_ajax_bear_dialog');

        $this->response = [
            'html' => $this->partial($lp->script(), [
                'pagingUrl' => 'ajax/message/message/paging',
                'profile'   => $viewer,
                'paging'    => $paging,
                'query'     => $query,
                'lp'        => $lp,
            ])
        ];
    }
}