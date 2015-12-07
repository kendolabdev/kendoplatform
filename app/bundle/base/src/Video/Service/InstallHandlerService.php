<?php
namespace Video\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Video\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'video';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Video';
}