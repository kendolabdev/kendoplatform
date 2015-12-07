<?php
namespace Group\Service;

use Kendo\Application\ModuleInstallHandler;


/**
 * Class InstallHandlerService
 *
 * @package Group\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'group';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Group';
}