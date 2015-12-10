<?php
namespace Platform\User\Controller;

use Base\Feed\Form\PosterNotificationTypeSetting;
use Platform\Core\Form\PosterPrivacySetting;
use Kendo\Acl\AuthorizationRestrictException;
use Kendo\Controller\DefaultController;

/**
 * Class SettingsController
 *
 * @package Platform\User\Controller
 */
class SettingsController extends DefaultController
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        \App::layoutService()
            ->setPageName('user_settings');

        if (!\App::authService()->logged())
            throw new AuthorizationRestrictException("");

        $this->view->assign(['viewer' => \App::authService()->getViewer()]);
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
        $form = new PosterPrivacySetting(['poster' => \App::authService()->getUser()]);


        $this->view->setScript('base/user/controller/settings/edit-user-privacy')
            ->assign(['form' => $form]);
    }

    /**
     * Edit user notification
     */
    public function actionNotification()
    {

        $user = \App::authService()->getUser();

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
        $viewer = \App::authService()->getViewer();

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