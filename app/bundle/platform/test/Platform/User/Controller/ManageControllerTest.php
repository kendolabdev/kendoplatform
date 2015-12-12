<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/11/15
 * Time: 4:54 PM
 */

namespace Platform\User\Controller;

use Kendo\Html\Form;
use Kendo\Test\ControllerTestCase;
use Platform\User\Form\UserCreateAccount;
use Platform\User\Form\UserCreateAvatar;

/**
 * Class ManageControllerTest
 *
 * @package Platform\Acl\Controller\Admin
 */
class ManageControllerTest extends ControllerTestCase
{
    /**
     *
     */
    public function testRequestLogin()
    {
        $this->dispatch('/login');

        $this->assertNoException();

        $this->assertControllerName('\Platform\User\Controller\AuthController');
        $this->assertActionName('login');
    }

    public function testLoginSuccess()
    {
        $this->dispatch('/login', 'post', [
            'email'    => 'admin@younetco.com',
            'password' => 'namnv123',
        ]);

        $this->assertControllerName('\Platform\User\Controller\AuthController');
        $this->assertActionName('login');
    }

    public function testLoginNoPassword()
    {
        $this->dispatch('/login', 'post', [
            'email'    => 'admin@younetco.com',
            'password' => '',
        ]);

        $this->assertControllerName('\Platform\User\Controller\AuthController');
        $this->assertActionName('login');
    }

    public function testLoginNoEmail()
    {
        $this->dispatch('/login', 'post', [
            'email'    => '',
            'password' => '',
        ]);

        $this->assertControllerName('\Platform\User\Controller\AuthController');
        $this->assertActionName('login');
    }

    public function testLogout()
    {
        $this->dispatch('/logout');
        $this->assertControllerName('\Platform\User\Controller\AuthController');
        $this->assertActionName('logout');
    }

    /**
     * TODO: Assert the result of exception here.
     */
    public function testActionLoginAs()
    {
        $this->dispatch('/user/login-as', 'get', [
            'type' => 'user',
            'id'   => 1,
        ]);
    }

    public function testForgotPassword()
    {
        $this->dispatch('/forgot-password');

        $this->assertControllerName('\Platform\User\Controller\AuthController');
        $this->assertActionName('forgot-password');
    }

    /**
     * TODO: Assert UserCreateAttribute
     */
    public function testFormSignup()
    {
        $form1 = new UserCreateAccount();
        $form1->asList([]);

        $form2 = new UserCreateAvatar();
        $form2->asList([]);

//        $form3 = new UserCreateAttribute();
//        $form3->asList([]);
    }




}