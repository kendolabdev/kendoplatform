<?php
namespace Place\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Place\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'place';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Place';
}