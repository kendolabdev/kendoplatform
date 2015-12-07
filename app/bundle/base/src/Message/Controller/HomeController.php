<?php
namespace Message\Controller;

use Kendo\Auth\AuthException;
use Kendo\Content\PosterInterface;
use Kendo\Controller\DefaultController;


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

        if (!\App::authService()->logged()) {
            throw new AuthException("Login Required");
        }
    }


    /**
     *
     */
    public function actionUnreadMessage()
    {
        $viewer = \App::authService()->getViewer();

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

        $lp = \App::layoutService()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'items' => $paging,
            ]);
    }

    /**
     *
     */
    public function actionInboxMessage()
    {
        $viewer = \App::authService()->getViewer();

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

        $lp = \App::layoutService()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'items' => $paging,
            ]);
    }

    /**
     *
     */
    public function actionSentMessage()
    {
        $viewer = \App::authService()->getViewer();

        /**
         * Select message
         */
        $paging = \App::table('message.message')
            ->select()
            ->where('poster_id=?', $viewer->getId())
            ->all();

        $lp = \App::layoutService()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([
                'items' => $paging,
            ]);
    }

    /**
     *
     */
    public function actionComposeMessage()
    {

        $form = \App::htmlService()->factory('\Message\Form\ComposeMessage');


        $recipientType = $this->request->getParam('recipientType');
        $recipientId = $this->request->getParam('recipientId');

        $recipient = null;

        if (!empty($recipientType) && !empty($recipientId)) {
            $recipient = \App::find($recipientType, $recipientId);
        }


        $this->view->assign([
            'form' => $form,
        ]);

        $poster = \App::authService()->getViewer();

        if ($this->request->isGet()) {

            $values = [];

            if (!empty($recipient)) {
                $values['recipients'][] = $recipient->getId() . '@' . $recipient->getType();
            }

            $form->setData($values);
        }

        $messageService = \App::messageService();

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

        $this->prepareRenderByContentLayoutParams();
    }
}