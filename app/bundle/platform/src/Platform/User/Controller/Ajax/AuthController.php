<?php
namespace Platform\User\Controller\Ajax;

use Kendo\Controller\AjaxController;
use Platform\User\Form\AuthLoginSmall;

class AuthController extends AjaxController
{

    /**
     * Open login dialog
     */
    public function actionLoginDialog()
    {
        $form = new AuthLoginSmall();
        $social = app()->socialService()->getListAuth();
        $enableSocialAuth = app()->setting('login', 'social_auth');

        $this->response['html'] = $this->partial('platform/user/dialog/login', ['form' => $form, 'social' => $social, 'enableSocialAuth' => $enableSocialAuth]);
    }
}