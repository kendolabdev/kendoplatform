<?php
namespace Review\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Review\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'review';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Review';
}