<?php
namespace Platform\Message\Controller;

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

        if (!app()->auth()->logged()) {
            throw new AuthException("Login Required");
        }
    }


    /**
     *
     */
    public function actionUnreadMessage()
    {
        $viewer = app()->auth()->getViewer();

        $messageIdList = app()->table('platform_message_recipient')
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
        $paging = app()->table('platform_message')
            ->select()
            ->where('message_id IN ?', $messageIdList)
            ->all();

        $lp = app()->layouts()
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
        $viewer = app()->auth()->getViewer();

        $messageIdList = app()->table('platform_message_recipient')
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
        $paging = app()->table('platform_message')
            ->select()
            ->where('message_id IN ?', $messageIdList)
            ->all();

        $lp = app()->layouts()
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
        $viewer = app()->auth()->getViewer();

        /**
         * Select message
         */
        $paging = app()->table('platform_message')
            ->select()
            ->where('poster_id=?', $viewer->getId())
            ->all();

        $lp = app()->layouts()
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

        $form = app()->html()->factory('\Message\Form\ComposeMessage');


        $recipientType = $this->request->getParam('recipientType');
        $recipientId = $this->request->getParam('recipientId');

        $recipient = null;

        if (!empty($recipientType) && !empty($recipientId)) {
            $recipient = app()->find($recipientType, $recipientId);
        }


        $this->view->assign([
            'form' => $form,
        ]);

        $poster = app()->auth()->getViewer();

        if ($this->request->isMethod('get')) {

            $values = [];

            if (!empty($recipient)) {
                $values['recipients'][] = $recipient->getId() . '@' . $recipient->getType();
            }

            $form->setData($values);
        }

        $messageService = app()->messageService();

        if ($this->request->isMethod('post')&& $form->isValid($_POST)) {
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

        $this->prepareRenderByContentLayoutParams();
    }
}