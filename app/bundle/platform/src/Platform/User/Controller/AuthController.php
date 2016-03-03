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

        if ($this->request->isMethod('post') && $form->isValid($this->request->getParams())) {

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
                return $this->request->redirect('home');
            }

            switch (true) {
                case $result->isInvalidIdentity():
                    exit('invalid identity');
                case $result->isInvalidCredentical():
                    exit('invalid credentical');
                case $result->isValid():
                    break;
                case $result->isEmptyIdentity():
                    exit('isEmptyIdentity');
                case $result->isEmptyCredentical():
                    exit('isEmptyCredentical');
                case $result->isBlocked():
                    exit('isBlocked');
                case $result->isDisabled():
                    exit('isDisabled');
                case $result->isUnapproved():
                    exit('isUnapproved');
                case $result->isUnverfied():
                    exit('isUnverfied');
                default:
                    exit('what happend');
                    break;
            }
        } else {
            // do no thing
        }

        $enableSocialAuth = \App::setting('login', 'social_auth');

        $social = \App::socialService()->getListAuth();

        $lp = \App::layouts()
            ->getContentLayoutParams();


        $this->view
            ->setScript($lp)
            ->assign([
                'form'             => $form,
                'social'           => $social,
                'enableSocialAuth' => $enableSocialAuth,
            ]);
    }

    /**
     * logout controller
     */
    public function actionLogout()
    {
        \App::authService()->logout();

        return $this->request->redirect('home');
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

        $this->request->redirectToUrl($poster->toHref());
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

        $lp = \App::layouts()->getContentLayoutParams();
        $this->view->setScript($lp);
    }
}