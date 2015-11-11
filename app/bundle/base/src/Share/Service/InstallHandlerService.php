<?php
namespace Share\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Share\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'share';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Share';
}