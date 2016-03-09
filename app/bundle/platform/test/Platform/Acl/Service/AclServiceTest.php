<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 8:13 AM
 */

namespace Platform\Acl\Service;


use Kendo\Package\BaseInstaller;

/**
 * Class AclServiceTest
 *
 * @package Platform\Acl\Service
 */
class AclServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test general method
     */
    public function testGeneral()
    {
        $aclService = new AclService();

        $aclService->reset();

        $aclService->findGroupById(1);

        $aclService->findRoleById(1);

        $this->assertEquals($aclService->getGroupOptions(), $aclService->getGroupOptionsFromRepository());
        $this->assertEquals($aclService->getRoleTypeOptions(), $aclService->getRoleTypeOptionsFromRepository());
        $aclService->loadForEdit(1, []);
        $aclService->loadForRole(1);
        $aclService->getData(1);
        $aclService->reset();
        $aclService->getData(1);
    }

    /**
     * Export acl service package
     */
    public function testExport()
    {
        $installer = app()->instance()->make('platform_acl_installer');

        if ($installer instanceof BaseInstaller) {
            $installer->export();
        }
    }

    public function testAddActionList()
    {
        $aclService = new AclService();

        $aclService->addActionList('unitest', 'unitest', [
            'unitest1', 'unitest2', 'unitest3',
        ]);
    }
}
