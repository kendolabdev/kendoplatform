<?php
namespace Subscription\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Subscription\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'subscription';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Subscription';
}