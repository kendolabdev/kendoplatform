<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 3:23 PM
 */

namespace Kendo\Package;
use Kendo\Test\TestCase;

/**
 * Class BaseInstallerTest
 *
 * @package Kendo\Package
 */
class BaseInstallerTest extends TestCase
{

    public function testBaseInstaller()
    {

        $installer = new BaseInstaller();

        $installer->setExportKey('module-unitest');

        $this->assertEquals($installer->getExportKey(), 'module-unitest');

        $installer->setModuleList([
            'base_blog',
            'base_event'
        ]);

        $installer->setPathList([
            '/app/bundle/base/src/Base/Blog',
            '/app/bundle/base/src/Base/Event',
        ]);

        $installer->setTableList([
            'platform_base_event',
            'platform_base_blog_post',
            'platform_base_blog_category',
        ]);

        $installer->export();
    }


}
