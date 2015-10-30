<?php
namespace Message\Controller;

use Picaso\Auth\AuthException;
use Picaso\Content\Poster;
use Picaso\Controller\DefaultController;


/**
 * Class HomeController
 *
 * @package Message\Controller
 */
class HomeController extends DefaultController
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        if (!\App::auth()->logged()) {
            throw new AuthException("Login Required");
        }
    }


    /**
     *
     */
    public function actionUnreadMessage()
    {
        $viewer = \App::auth()->getViewer();

        $messageIdList = \App::table('message.recipient')
            ->select()
            ->where('recipient_id=?', $viewer->getId())
            ->where('is_active=?', 1)
            ->where('unread_count <> ?', 0)
            ->fields('last_message_id');

        /**
         * Prevent sql error
         */
        if (empty($messageIdList)) {
            $messageIdList[] = 0;
        }

        /**
         * Select message
         */
        $paging = \App::table('message.message')
            ->select()
            ->where('message_id IN ?', $messageIdList)
            ->all();

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'items' => $paging,
            ]);
    }

    /**
     *
     */
    public function actionInboxMessage()
    {
        $viewer = \App::auth()->getViewer();

        $messageIdList = \App::table('message.recipient')
            ->select()
            ->where('recipient_id=?', $viewer->getId())
            ->where('is_active=?', 1)
            ->fields('last_message_id');

        /**
         * Prevent sql error
         */
        if (empty($messageIdList)) {
            $messageIdList[] = 0;
        }

        /**
         * Select message
         */
        $paging = \App::table('message.message')
            ->select()
            ->where('message_id IN ?', $messageIdList)
            ->all();

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'items' => $paging,
            ]);
    }

    /**
     *
     */
    public function actionSentMessage()
    {
        $viewer = \App::auth()->getViewer();

        /**
         * Select message
         */
        $paging = \App::table('message.message')
            ->select()
            ->where('poster_id=?', $viewer->getId())
            ->all();

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'items' => $paging,
            ]);
    }

    /**
     *
     */
    public function actionComposeMessage()
    {

        $form = \App::html()->factory('\Message\Form\ComposeMessage');


        $recipientType = $this->request->getParam('recipientType');
        $recipientId = $this->request->getParam('recipientId');

        $recipient = null;

        if (!empty($recipientType) && !empty($recipientId)) {
            $recipient = \App::find($recipientType, $recipientId);
        }


        $this->view->assign([
            'form' => $form,
        ]);

        $poster = \App::auth()->getViewer();

        if ($this->request->isGet()) {

            $values = [];

            if (!empty($recipient)) {
                $values['recipients'][] = $recipient->getId() . '@' . $recipient->getType();
            }

            $form->setData($values);
        }

        $messageService = \App::message();

        if ($this->request->isPost() && $form->isValid($_POST)) {
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

                if (!null == $user && $user instanceof Poster) {
                    $users[] = $user;
                }
                /**
                 * TODO: check permission to send message if needed. fail from follow
                 */
            }

            $messageService->addMessage($poster, $users, $subject, $content);

            \App::routing()->redirect('message_inbox');
        }

        $this->prepareRenderByContentLayoutParams();
    }
}