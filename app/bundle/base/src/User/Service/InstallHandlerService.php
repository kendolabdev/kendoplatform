<?php
namespace User\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package User\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'user';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/User';
}