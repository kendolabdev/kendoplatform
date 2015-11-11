<?php
namespace Like\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Like\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'like';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Like';
}