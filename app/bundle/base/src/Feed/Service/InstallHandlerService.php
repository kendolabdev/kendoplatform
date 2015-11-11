<?php
namespace Feed\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Feed\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'feed';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Feed';
}