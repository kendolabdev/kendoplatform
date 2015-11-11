<?php
namespace Tag\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Tag\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'tag';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Tag';
}