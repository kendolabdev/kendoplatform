<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 12:37 AM
 */

namespace Platform\Core\Service;
use Kendo\Test\TestCase;

/**
 * Class ExtensionServiceTest
 *
 * @package Platform\Core\Service
 */
class ExtensionServiceTest extends TestCase
{
    public function testGeneral()
    {
        $extService = \App::coreService()->extension();

        $extService->findExensionById(1);
        $extService->findExtensionByName('platform_core');
        $extService->getModuleOptions();
        $extService->collectListAvailablePackageInformation();
        $extService->collectListPackageInformation();

    }
}
