<?php
namespace User\Controller;

use Feed\Form\PosterNotificationTypeSetting;
use Core\Form\PosterPrivacySetting;
use Picaso\Acl\AuthorizationRestrictException;
use Picaso\Controller\DefaultController;

/**
 * Class SettingsController
 *
 * @package User\Controller
 */
class SettingsController extends DefaultController
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        \App::layout()
            ->setPageName('user_settings');

        if (!\App::auth()->logged())
            throw new AuthorizationRestrictException("");

        $this->view->assign(['viewer' => \App::auth()->getViewer()]);
    }


    /**
     * Edit user account settings
     */
    public function actionAccount()
    {
        $this->view->setScript('base/user/controller/settings/edit-user-account');
    }

    /**
     * Edit user privacy settings
     */
    public function actionPrivacy()
    {
        $form = new PosterPrivacySetting(['poster' => \App::auth()->getUser()]);


        $this->view->setScript('base/user/controller/settings/edit-user-privacy')
            ->assign(['form' => $form]);
    }

    /**
     * Edit user notification
     */
    public function actionNotification()
    {

        $user = \App::auth()->getUser();

        $form = new PosterNotificationTypeSetting(['poster' => $user]);


        if ($this->request->isGet()) {
            $form->load();
        }

        if ($this->request->isPost() && $form->isValid($_POST)) {
            $form->save();
        }

        $this->view->setScript('base/user/controller/settings/edit-user-notification')
            ->assign([
                'form' => $form,
            ]);
    }

    /**
     * Edit user security
     */
    public function actionSecurity()
    {
        $this->view->setScript('base/user/controller/settings/edit-user-security');
    }

    /**
     * Edit user security
     */
    public function actionMobile()
    {
        $this->view->setScript('base/user/controller/settings/edit-user-security');
    }

    /**
     * Edit user blocking
     */
    public function actionBlock()
    {
        $viewer = \App::auth()->getViewer();

        if (null == $viewer) {
            // required login
        }

        $blockingItems = [];

        $items = \App::table('core.block')
            ->select()
            ->where('poster_id=?', $viewer->getId())
            ->all();

        /**
         * validate object is not null
         */
        foreach ($items as $item) {
            if (null != ($object = \App::find($item->getObjectType(), $item->getObjectId()))) {
                $blockingItems[] = $object;
            }
        }


        $this->view->setScript('base/user/controller/settings/edit-user-blocking')
            ->assign([
                'blockingItems' => $blockingItems,
            ]);
    }

    /**
     * Edit user social connect account
     */
    public function actionSocialConnect()
    {
        $this->view->setScript('base/user/controller/settings/edit-user-social-connect');
    }
}