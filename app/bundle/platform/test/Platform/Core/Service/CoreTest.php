<?php
namespace Platform\Core\Service;

use Kendo\TestCase;

class CoreTest extends TestCase
{
    public function testGeneral()
    {
        $coreService = \App::coreService();

        $this->assertEquals($coreService->loadTypeOptions(), $coreService->loadTypeOptionsFromRepository());

        $this->assertNotEmpty($coreService->hook());
        $this->assertNotEmpty($coreService->extension());

        $this->assertNotEmpty($coreService->getListTypeByModuleName(['platform_core']));
    }
}