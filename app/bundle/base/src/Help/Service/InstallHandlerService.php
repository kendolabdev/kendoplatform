<?php
namespace Help\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Help\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'help';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Help';
}