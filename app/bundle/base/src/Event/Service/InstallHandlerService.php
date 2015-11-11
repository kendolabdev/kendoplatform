<?php
namespace Event\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Event\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'event';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Event';
}