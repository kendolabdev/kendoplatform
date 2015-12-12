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
            'platform_blog',
            'platform_event'
        ]);

        $installer->setPathList([
            '/app/bundle/platform/src/Platform/Blog',
            '/app/bundle/platform/src/Platform/Event',
        ]);

        $installer->setTableList([
            'platform_event',
            'platform_blog_post',
            'platform_blog_category',
        ]);

        $installer->export();
    }


}
