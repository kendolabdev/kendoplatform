<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/11/15
 * Time: 10:26 PM
 */

namespace Platform\User\Service;


use Base\Event\ViewHelper\ButtonMembership;
use Kendo\Html\Form;
use Kendo\Layout\Block;
use Platform\User\Model\User;
use Platform\User\Module;
use Platform\User\ViewHelper\ButtonBearAccount;
use Platform\User\ViewHelper\ButtonLoginAs;
use Platform\User\ViewHelper\ButtonMemberCount;
use Platform\User\ViewHelper\ButtonTopbarViewer;

class UserServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function adminUserPagingSearchProvider()
    {
        return [
            [[], 1, 1],
            [['role' => 1], 1, 10],
            [['active' => 0], 1, 10],
            [['active' => 1], 1, 10],
            [['gender' => 1], 1, 10],
            [['gender' => 0], 1, 10],
            [['verified' => 1], 1, 10],
            [['approve' => 1], 1, 10],
            [['q' => 'test'], 1, 10],
            [['photo' => '1'], 1, 10],
            [['created' => '1hour'], 1, 10],
            [['created' => 'today'], 1, 10],
            [['created' => '24hours'], 1, 10],
            [['created' => '7days'], 1, 10],
            [['created' => '30days'], 1, 10],
            [['created' => 'this_month'], 1, 10],
            [['created' => 'this_year'], 1, 10],
        ];
    }

    /**
     * @dataProvider adminUserPagingSearchProvider
     *
     * @param array $query
     * @param int   $page
     * @param int   $limit
     */
    public function testLoadAdminUserPaging($query, $page, $limit = 2)
    {
        $paging = \App::userService()
            ->loadAdminUserPaging($query, $page, $limit);

        $this->assertNotNull($paging);
    }

    /**
     * @return array
     */
    public function loadUserPagingProvider()
    {
        return [
            [[], 1, 1],
            [['sort' => 'rand'], 1, 1],
        ];
    }

    /**
     * @dataProvider loadUserPagingProvider
     *
     * @param     $query
     * @param     $page
     * @param int $limit
     *
     */
    public function testLoadUserPaging($query, $page, $limit = 2)
    {
        $paging = \App::userService()
            ->loadUserPaging($query, $page, $limit);

        $this->assertNotNull($paging);
    }

    public function testCountActiveUser()
    {
        \App::userService()->getActiveUserCount();
    }

    public function testMembership()
    {
        \App::userService()->membership();
    }

    public function testFindUserByIdentity()
    {
        $user = \App::userService()->findUserByIdentity(1);

        $this->assertNull($user);

        $user = \App::table('platform_user')
            ->select()
            ->setOffset(2)
            ->one();

        $user2 = \App::table('platform_user')
            ->select()
            ->one();

        $this->assertNotNull($user);

        if (!$user instanceof User) ;

        $user1 = \App::userService()->findUserByIdentity($user->getId());
        $this->assertEquals($user1, $user);

        $user1 = \App::userService()->findUserByIdentity($user->getEmail());
        $this->assertEquals($user1, $user);

        $user1 = \App::userService()->findUserByIdentity($user->getProfileName());
        $this->assertEquals($user1, $user);

        $user1 = \App::userService()->findUserByEmail($user->getEmail());
        $this->assertEquals($user1, $user);

        $user1 = \App::userService()->findUserByProfileName($user->getProfileName());
        $this->assertEquals($user1, $user);

        $password = \App::userService()->findPassword($user->getId(), 'default');

        $this->assertNotEmpty($password);

        $user->btnMemberCount();
        $user->btnMembership();

        \App::authService()
            ->setViewer($user);

        (new ButtonLoginAs())->__invoke($user2);
        (new ButtonMemberCount())->__invoke($user2);
        (new ButtonTopbarViewer())->__invoke();
        (new ButtonMembership())->__invoke($user2);
        (new ButtonBearAccount())->__invoke();

    }

    public function testGeneral()
    {
        \App::userService()->getGuestRoleId();

        \App::userService()->getDefaultRoleId();
    }

    /**
     * @return array
     */
    public function userFormProvider()
    {
        $guest = \App::table('platform_acl_role')
            ->select()
            ->where('is_guest=?', 1)
            ->one();

        $member = \App::table('platform_acl_role')
            ->select()
            ->where('is_member=?', 1)
            ->one();

        return [
            ['\Platform\User\Form\Admin\FilterUser', [], []],
            ['\Platform\User\Form\Admin\LoginSetting', [], []],
            ['\Platform\User\Form\Admin\RegisterSetting', [], []],
            ['\Platform\User\Form\Admin\UserPermission', ['role' => $guest], []],
            ['\Platform\User\Form\Admin\UserPermission', ['role' => $member], []],
            ['\Platform\User\Form\Admin\UserSetting', [], []],
        ];
    }

    /**
     * @dataProvider userFormProvider
     *
     * @param       $formClass
     * @param       $formParams
     * @param array $formPost
     */
    public function testUserForms($formClass, $formParams, $formPost = [])
    {
        $form = new $formClass($formParams);

        if (!$form instanceof Form) ;

        $form->isValid($formParams);
    }

    /**
     * @return array
     *
     * TODO: setup a simple page and http request then execute this block
     */
    public function blocksProvider()
    {
        return [
            ['\Platform\User\Block\EditProfileMenuBlock', []],
            ['\Platform\User\Block\ListingUserItemBlock', []],
            ['\Platform\User\Block\MenuSettingsBlock', []],
            ['\Platform\User\Block\RecentSignUpBlock', []],
            ['\Platform\User\Block\SmallLoginFormBlock', []],
//            ['\Platform\User\Block\TimelineHeaderBlock', []],
            ['\Platform\User\Block\UserProfileInfoBlock', []],
        ];
    }

    /**
     * @dataProvider blocksProvider
     *
     * @param $blockClass
     * @param $blockParams
     *
     * TODO: try call render
     */
    public function testBlocks($blockClass, $blockParams)
    {
        $block = new $blockClass($blockParams);

        if (!$block instanceof Block) ;

        $block->execute();
    }

    public function testInitModule()
    {
        $module = new Module();

        $module->start();
        $module->complete();
    }

}
