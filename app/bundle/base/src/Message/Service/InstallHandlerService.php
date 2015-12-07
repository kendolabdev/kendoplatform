<?php
namespace Message\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Message\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'message';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Message';
}