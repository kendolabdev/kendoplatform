<?php
namespace Help\Service;

use Kendo\Application\ModuleInstallHandler;

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