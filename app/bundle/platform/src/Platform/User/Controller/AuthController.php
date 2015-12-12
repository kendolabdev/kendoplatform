<?php

namespace Platform\User\Controller;

use Kendo\Content\PosterInterface;
use Kendo\Controller\DefaultController;
use Platform\User\Form\AuthLoginSmall;
use Platform\User\Form\ForgotPasswordForm;

/**
 * Class AuthController
 *
 * @package Platform\User\Controller
 */
class AuthController extends DefaultController
{
    /**
     * Overwrite this method to allow guest access login
     *
     * @return bool
     */
    protected function passNetworkBrowseMode()
    {
        return true;
    }


    /**
     * Login by account password
     */
    public function actionLogin()
    {
        $form = new AuthLoginSmall();

        if ($this->request->isPost() && $form->isValid($this->request->getParams())) {

            $data = $form->getData();

            $driver = 'default';

            $params = [
                'identity'   => $data['email'],
                'credential' => $data['password'],
                'remember'   => isset($data['remember']) ? $data['remember'] : false
            ];

            $result = \App::authService()->login($driver, $params);

            if ($result->isValid()) {

                \App::authService()->store($result->getUser(), null, false);

                // try location redirect then exists
                return $this->redirect('home');
            }

            switch (true) {
                case $result->isValid():
                    break;
                case $result->isEmptyIdentity():
                case $result->isEmptyCredentical():
                case $result->isInvalidIdentity():
                case $result->isBlocked():
                case $result->isDisabled():
                case $result->isUnapproved():
                case $result->isUnverfied():
                    break;
            }
        }

        $enableSocialAuth = \App::setting('login', 'social_auth');

        $social = \App::socialService()->getListAuth();

        $lp = \App::layoutService()
            ->getContentLayoutParams();


        $this->view
            ->setScript($lp)
            ->assign([
                'form'             => $form,
                'social'           => $social,
                'enableSocialAuth' => $enableSocialAuth,
            ]);
    }

    public function actionLogout()
    {
        \App::authService()->logout();

        return $this->redirect('home');
    }

    /**
     *
     */
    public function actionLoginAs()
    {
        $type = $this->request->getString('type');
        $id = $this->request->getString('id');

        $poster = \App::find($type, $id);

        if (!$poster instanceof PosterInterface) {
            throw new \InvalidArgumentException("Unexpected login as member.");
        }

        \App::authService()->saveViewer($poster);

        \App::routingService()->redirectToUrl($poster->toHref());
    }

    /**
     * forgot password
     */
    public function actionForgotPassword()
    {
        $form = new ForgotPasswordForm([]);

        $this->view->assign([
            'form' => $form
        ]);

        $lp = \App::layoutService()->getContentLayoutParams();
        $this->view->setScript($lp);
    }
}