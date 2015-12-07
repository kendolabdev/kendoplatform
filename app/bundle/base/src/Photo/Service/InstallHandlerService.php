<?php
namespace Photo\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Photo\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'photo';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Photo';
}