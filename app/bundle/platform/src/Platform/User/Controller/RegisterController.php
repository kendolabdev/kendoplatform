<?php
namespace Platform\User\Controller;

use Kendo\Controller\DefaultController;
use Platform\User\Form\UserCreateAccount;
use Platform\User\Form\UserCreateAttribute;
use Platform\User\Form\UserCreateAvatar;

/**
 * Class RegisterController
 *
 * @package Platform\User\Controller
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

        $lp = app()->layouts()->getContentLayoutParams();

        if (!$step) {
            $form = new UserCreateAccount();

            if ($this->request->isMethod('get')) {
                $form->setData($this->getData());
            }

            if ($this->request->isMethod('post') && $form->isValid($_POST)) {
                $this->mergeData($form->getData());
                app()->routing()
                    ->redirect('register', ['_step' => 1]);
            }
        } else if ($step == 1) {

            $catalogId = 3;
            $form = new UserCreateAttribute(['catalogId' => $catalogId]);

            if ($this->request->isMethod('get')) {
                $form->setData($this->getData());
            }

            if ($this->request->isMethod('post') && $form->isValid($_POST)) {
                $this->mergeData($form->getData());
                app()->routing()
                    ->redirect('register', ['_step' => 2]);
            }

        } else if ($step == 2) {
            // custom avatar fields

            $form = new UserCreateAvatar();

            if ($this->request->isMethod('get')) {
                $form->setData($this->getData());
            }

            if ($this->request->isMethod('post') && $form->isValid($_POST)) {

                $this->mergeData($form->getData());

                $this->request->forward(null, 'complete');
            }
        }

        $this->view->setScript($lp)
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

        $user() = app()->user();

        $user = $user()->addUser($data);

        if (!$user) {

        }

        if ($user) {
            app()->auth()->store($user);
            app()->routing()->redirect('home');
        }
    }

}