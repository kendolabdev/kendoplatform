<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/11/15
 * Time: 4:54 PM
 */

namespace Platform\User\Controller;

use Kendo\Test\ControllerTestCase;

/**
 * Class ManageControllerTest
 *
 * @package Platform\Acl\Controller\Admin
 */
class AuthControllerTest extends ControllerTestCase
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
    }

    public function testForgotPassword()
    {
        $this->dispatch('/forgot-password');

        $this->assertControllerName('\Platform\User\Controller\AuthController');
        $this->assertActionName('forgot-password');
    }
}
