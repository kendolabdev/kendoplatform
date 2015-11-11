<?php
namespace Blog\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Blog\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{

    /**
     * @var string
     */
    protected $moduleName = 'blog';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Blog';
}