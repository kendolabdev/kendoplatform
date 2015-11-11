<?php
namespace Relation\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Relation\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'relation';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Relation';
}