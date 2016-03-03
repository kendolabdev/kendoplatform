<?php
namespace Platform\Core\Service;


use Kendo\Test\TestCase;

/**
 * Class HookTest
 *
 * @package Platform\Core\Service
 */
class HookTest extends TestCase
{
    public function testGeneral()
    {
        $hookService = \App::coreService()
            ->hook();

        $this->assertEquals($hookService->loadAllHooks(), $hookService->loadAllHookFromRepository());

        $hookService->scanHookFromEnableModulesThenImportToRepository();

//        $hookService->cleanupHooks();

    }
}