<?php
namespace Platform\Social\Controller;

use Kendo\Controller\DefaultController;
use Platform\Social\Adapter\SocialLoginAdapterInterface;
use Platform\Social\Service\SocialService;
use Platform\User\Model\User;


/**
 * Class ConnectController
 *
 * @package Social\Controller
 */
class ConnectController extends DefaultController
{
    /**
     * Override this method to allow guest access connect method
     *
     * @return bool
     */
    protected function passNetworkBrowseMode()
    {
        return true;
    }


    /**
     * @return \Platform\User\Service\UserService
     */
    public function getUserService()
    {
        return app()->instance()->make('platform_user');
    }

    /**
     *
     */
    public function actionConnect()
    {
        $service = $this->request->getString('service', 'facebook');

        $socialService = app()->instance()->make('platform_social');

        if (!$socialService instanceof SocialService) ;

        $adapter = $socialService->getAdapter($service);

        if (!$adapter instanceof SocialLoginAdapterInterface) ;

        $url = $adapter->getLoginUrl([]);

        $this->request->redirectToUrl($url);
    }

    public function actionCallback()
    {
        $service = $this->request->getString('service', 'facebook');

        $socialService = app()->instance()->make('platform_social');

        if (!$socialService instanceof SocialService) ;

        $adapter = $socialService->getAdapter($service);

        if (!$adapter instanceof SocialLoginAdapterInterface) ;


        $token = $adapter->getTokenFromRedirect();

        $url = null;

        if ($token) {
            $url = app()->routing()->getUrl('oauth_success', ['service' => $service]);
        } else {
            $url = app()->routing()->getUrl('oauth_failure', ['service' => $service]);

        }
        $this->request->redirectToUrl($url);
    }


    /**
     *
     */
    public function actionSuccess()
    {
        $service = $this->request->getString('service', 'facebook');

        $socialService = app()->instance()->make('platform_social');

        if (!$socialService instanceof SocialService) ;

        $adapter = $socialService->getAdapter($service);

        if (!$adapter instanceof SocialLoginAdapterInterface) ;

        $me = $adapter->getAccountInfo();


        if (empty($me['remote_uid']) || empty($me['remote_service'])) {
            throw new \RuntimeException("Something wrong");
        }


        /**
         * Select auth user from these information.
         */

        $remote = app()->table('platform_user_auth_remote')
            ->select()
            ->where('remote_uid=?', (string)$me['remote_uid'])
            ->where('remote_service=?', (string)$me['remote_service'])
            ->one();


        /**
         * what you want to next step
         */
        if (null == $remote) {
            // try to pass user by email
            $user = $this->getUserService()->findUserByEmail($me['email']);

            if ($user instanceof User) {
                $this->getUserService()->addRemoteUser($user, $me['remote_uid'], $me['remote_service']);

                app()->auth()->store($user, null, false);

                app()->routing()->redirect('home');

            }
        }

        /**
         * logged in identity
         */

        $gotoRegister = true;


        if (app()->auth()->logged()) {
            $this->getUserService()->addRemoteUser(app()->auth()->getUser(), $me['remote_uid'], $me['remote_service']);

            // try location redirect then exists
            $this->request->redirect('home');
        } else {
            // try to logged in to this account with back
            if (null == $remote) {

            } else if (null != $remote->__get('user_id')) {
                // validate current user result


                $user = app()->table('platform_user')
                    ->findById((string)$remote->__get('user_id'));

                if ($user) {
                    // try to logged in with current user result
                    $result = app()->auth()->login('remote', [
                        'identity'   => $me['remote_uid'],
                        'credential' => $me['remote_service'],
                    ]);

                    if ($result->isValid()) {

                        app()->auth()->store($result->getUser(), null, false);

                        // try location redirect then exists
                        return $this->request->redirect('home');
                    }
                }
            }


        }

        if ($gotoRegister) {
            $_SESSION['user_create'] = $me;
            $this->request->redirect('register', ['remote_service' => $me['remote_service']]);
        }
    }

    public function actionFailure()
    {

    }

}
