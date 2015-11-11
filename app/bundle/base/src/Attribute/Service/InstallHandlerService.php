<?php
namespace Attribute\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Attribute\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'attribute';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Attribute';
}