<?php
namespace Page\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Page\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'page';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Page';
}