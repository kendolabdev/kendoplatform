<?php
namespace Follow\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Follow\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'follow';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Follow';
}