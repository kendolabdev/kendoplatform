<?php
namespace Core\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Core\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'core';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Core';

    /**
     *
     */
    public function afterImport()
    {
        \App::table('core.core_uid_generator')
            ->insertIgnore(['uid' => 1000]);

    }
}