<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 8:13 AM
 */

namespace Platform\Acl\Service;


class AclServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneral()
    {
        $aclService = \App::aclService();

        $aclService->reset();

        $aclService->findGroupById(1);

        $aclService->findRoleById(1);

        $this->assertEquals($aclService->getGroupOptions(), $aclService->getGroupOptionsFromRepository());
        $this->assertEquals($aclService->getRoleTypeOptions(), $aclService->getRoleTypeOptionsFromRepository());
        $aclService->loadForEdit(1,[]);
        $aclService->loadForRole(1);
        $aclService->getData(1);
        $aclService->reset();
        $aclService->getData(1);
    }
}
