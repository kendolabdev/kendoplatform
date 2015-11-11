<?php
namespace Comment\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Comment\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'comment';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Comment';
}