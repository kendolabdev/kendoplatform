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
        $social = \App::socialService()->getListAuth();
        $enableSocialAuth = \App::setting('login', 'social_auth');

        $this->response['html'] = $this->partial('base/user/dialog/login', ['form' => $form, 'social' => $social, 'enableSocialAuth' => $enableSocialAuth]);
    }
}