<?php
namespace Platform\Core\Service;

use Kendo\Test\TestCase;

/**
 * Class CoreTest
 *
 * @package Platform\Core\Service
 */
class CoreTest extends TestCase
{
    public function testGeneral()
    {
        $coreService = app()->coreService();

        $coreService->loadTypeOptions();

        $coreService->loadTypeOptionsFromRepository();

        $this->assertNotEmpty($coreService->hook());
        $this->assertNotEmpty($coreService->extension());

        $this->assertNotEmpty($coreService->getListTypeByModuleName(['platform_core']));
    }
}