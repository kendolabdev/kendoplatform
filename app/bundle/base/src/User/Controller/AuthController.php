<?php

namespace User\Controller;

use Picaso\Content\Poster;
use Picaso\Controller\DefaultController;
use User\Form\AuthLoginSmall;
use User\Form\ForgotPasswordForm;

/**
 * Class AuthController
 *
 * @package User\Controller
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

        if ($this->request->isPost() && $form->isValid($_POST)) {

            $data = $form->getData();

            $driver = 'default';

            $params = [
                'identity'   => $data['email'],
                'credential' => $data['password'],
                'remember'   => isset($data['remember']) ? $data['remember'] : false
            ];

            $result = \App::auth()->login($driver, $params);

            if ($result->isValid()) {

                \App::auth()->store($result->getUser(), null, false);

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

        $social = \App::social()->getListAuth();

        $lp = \App::layout()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp->script())
            ->assign([
                'form'             => $form,
                'social'           => $social,
                'enableSocialAuth' => $enableSocialAuth,
            ]);
    }

    public function actionLogout()
    {
        \App::auth()->logout();

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

        if (!$poster instanceof Poster) {
            // could not login as this poster
        }

        \App::auth()->saveViewer($poster);

        \App::routing()->redirectToUrl($poster->toHref());
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

        $lp = \App::layout()->getContentLayoutParams();

        $this->view->setScript($lp->script());

    }

}