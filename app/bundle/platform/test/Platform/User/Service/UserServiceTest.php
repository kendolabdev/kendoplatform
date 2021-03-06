<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/11/15
 * Time: 10:26 PM
 */

namespace Platform\User\Service;


use Platform\Event\ViewHelper\ButtonMembership;
use Kendo\Html\Form;
use Kendo\Layout\BlockController;
use Platform\User\Model\User;
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
        $paging = app()->user()
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
        $paging = app()->user()
            ->loadUserPaging($query, $page, $limit);

        $this->assertNotNull($paging);
    }

    public function testCountActiveUser()
    {
        app()->user()->getActiveUserCount();
    }

    public function testMembership()
    {
        app()->user()->membership();
    }

    public function testFindUserByIdentity()
    {
        $user = app()->user()->findUserByIdentity(1);

        $this->assertNull($user);

        $user = app()->table('platform_user')
            ->select()
            ->setOffset(2)
            ->one();

        $user2 = app()->table('platform_user')
            ->select()
            ->one();

        $this->assertNotNull($user);

        if (!$user instanceof User) ;

        $user1 = app()->user()->findUserByIdentity($user->getId());
        $this->assertEquals($user1, $user);

        $user1 = app()->user()->findUserByIdentity($user->getEmail());
        $this->assertEquals($user1, $user);

        $user1 = app()->user()->findUserByIdentity($user->getProfileName());
        $this->assertEquals($user1, $user);

        $user1 = app()->user()->findUserByEmail($user->getEmail());
        $this->assertEquals($user1, $user);

        $user1 = app()->user()->findUserByProfileName($user->getProfileName());
        $this->assertEquals($user1, $user);

        $password = app()->user()->findPassword($user->getId(), 'default');

        $this->assertNotEmpty($password);

        $user->btnMemberCount();
        $user->btnMembership();

        app()->auth()
            ->setViewer($user);

        (new ButtonLoginAs())->__invoke($user2);
        (new ButtonMemberCount())->__invoke($user2);
        (new ButtonTopbarViewer())->__invoke();
        (new ButtonMembership())->__invoke($user2);
        (new ButtonBearAccount())->__invoke();

    }

    public function testGeneral()
    {
        app()->user()->getGuestRoleId();

        app()->user()->getDefaultRoleId();
    }

    /**
     * @return array
     */
    public function userFormProvider()
    {
        $guest = app()->table('platform_acl_role')
            ->select()
            ->where('is_guest=?', 1)
            ->one();

        $member = app()->table('platform_acl_role')
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

        if (!$block instanceof BlockController) ;

        $block->execute();
    }
}
