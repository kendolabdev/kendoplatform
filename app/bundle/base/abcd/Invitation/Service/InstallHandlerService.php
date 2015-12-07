<?php
namespace Invitation\Service;

use Kendo\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Invitation\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'invitation';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Invitation';
}