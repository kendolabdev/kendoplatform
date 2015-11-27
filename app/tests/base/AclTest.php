<?php
namespace TestBase;

/**
 * Class AclTest
 *
 * @package BaseTest
 */
class AclTest extends BaseTestCase
{
    public function testLoadAction(){

        $acl =    \App::aclService();

        $this->assertInstanceOf('\Acl\Service\AclService',$acl,"invalid class map");

        $data = $acl->loadForRole(1);

        $this->assertEquals($data['is_member'],0, "Member values");

        $this->assertEquals(\App::aclService()->authorize('is_guest'),0);

    }
}