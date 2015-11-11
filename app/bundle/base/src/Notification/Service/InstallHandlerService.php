<?php
namespace Notification\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Notification\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'notification';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Notification';
}