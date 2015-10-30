<?php
namespace Notification\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Notification\Service
 */
class InstallHandlerService extends InstallHandler
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