<?php
namespace User\Controller;

use Core\Service\ProfileService;
use Picaso\Controller\DefaultController;
use User\Form\UserCreateAccount;
use User\Form\UserCreateAttribute;
use User\Form\UserCreateAvatar;
use User\Service\UserService;

/**
 * Class RegisterController
 *
 * @package User\Controller
 */
class RegisterController extends DefaultController
{
    /**
     *
     */
    const DATA_SESSION_KEY = 'USER_REGISTER';

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
     * @return mixed
     */
    protected function getData()
    {
        if (empty($_SESSION[ self::DATA_SESSION_KEY ]))
            $_SESSION[ self::DATA_SESSION_KEY ] = [];

        return $_SESSION[ self::DATA_SESSION_KEY ];
    }

    /**
     * @param $data
     */
    protected function setData($data)
    {
        $_SESSION[ self::DATA_SESSION_KEY ] = $data;
    }

    /**
     * @param $data
     */
    protected function mergeData($data)
    {
        $this->setData(array_merge($this->getData(), $data));
    }

    /**
     *
     */
    public function actionIndex()
    {

        $step = $this->request->getParam('_step');

        $lp = \App::layout()->getContentLayoutParams();

        if (!$step) {
            $form = new UserCreateAccount();

            if ($this->request->isGet()) {
                $form->setData($this->getData());
            }

            if ($this->request->isPost() && $form->isValid($_POST)) {
                $this->mergeData($form->getData());
                \App::routing()
                    ->redirect('register', ['_step' => 1]);
            }
        } else if ($step == 1) {

            $catalogId = 3;
            $form = new UserCreateAttribute(['catalogId' => $catalogId]);

            if ($this->request->isGet()) {
                $form->setData($this->getData());
            }

            if ($this->request->isPost() && $form->isValid($_POST)) {
                $this->mergeData($form->getData());
                \App::routing()
                    ->redirect('register', ['_step' => 2]);
            }

        } else if ($step == 2) {
            // custom avatar fields

            $form = new UserCreateAvatar();

            if ($this->request->isGet()) {
                $form->setData($this->getData());
            }

            if ($this->request->isPost() && $form->isValid($_POST)) {

                $this->mergeData($form->getData());

                $this->forward(null, 'complete');
            }
        }

        $this->view->setScript($lp->script())
            ->assign([
                'form' => $form,
                'lp'   => $lp,
            ]);
    }


    /**
     * action complete
     */
    public function actionComplete()
    {
        $data = $this->getData();

        $userService = \App::user();

        $user = $userService->addUser($data);

        if (!$user) {

        }

        if ($user) {
            \App::auth()->store($user);
            \App::routing()->redirect('home');
        }
    }

}