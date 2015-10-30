<?php
namespace Subscription\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Subscription\Service
 */
class InstallHandlerService extends InstallHandler
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