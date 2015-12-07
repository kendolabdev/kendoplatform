<?php
namespace Payment\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Payment\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'payment';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Payment';
}