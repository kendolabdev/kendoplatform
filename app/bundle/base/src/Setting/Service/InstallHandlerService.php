<?php
namespace Setting\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Setting\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'setting';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Setting';
}