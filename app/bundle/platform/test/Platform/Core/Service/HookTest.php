<?php
namespace Platform\Core\Service;

use Kendo\TestCase;

class HookTest extends TestCase
{
    public function testGeneral()
    {
        $hookService = \App::coreService()
            ->hook();

        $this->assertEquals($hookService->loadAllHooks(), $hookService->loadAllHookFromRepository());

        $hookService->scanHookFromEnableModulesThenImportToRepository();

        $hookService->cleanupHooks();
        $hookService->getListHookByModuleName(['platform_core']);

    }
}