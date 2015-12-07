<?php
namespace Link\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Link\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'link';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Link';
}