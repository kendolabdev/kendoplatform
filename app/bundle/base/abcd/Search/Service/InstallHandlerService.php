<?php
namespace Search\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Search\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'search';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Search';
}