<?php
namespace Setting\Service;

use Kendo\Application\ModuleInstallHandler;

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