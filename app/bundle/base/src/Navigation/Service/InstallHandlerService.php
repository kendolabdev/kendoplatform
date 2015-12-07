<?php
namespace Navigation\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Navigation\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'navigation';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Navigation';
}