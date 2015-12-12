<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/11/15
 * Time: 9:53 PM
 */

namespace Platform\User\Controller;


use Kendo\Test\ControllerTestCase;

/**
 * Class HomeControllerTest
 *
 * @package Platform\User\Controller
 */
class HomeControllerTest extends ControllerTestCase
{

    /**
     * Test access browser action without errors.
     */
    public function testBrowseAction()
    {
        $this->dispatch('/members');

        $this->assertControllerName('\Platform\User\Controller\HomeController');
        $this->assertActionName('browse-user');
    }

    /**
     * Test access browser action without errors.
     */
    public function testFindFriendAction()
    {
        $this->dispatch('/find-friends');

        $this->assertControllerName('\Platform\User\Controller\HomeController');
        $this->assertActionName('find-friend');
    }
}
