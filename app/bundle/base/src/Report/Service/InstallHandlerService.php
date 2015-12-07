<?php
namespace Report\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Report\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'report';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Report';
}