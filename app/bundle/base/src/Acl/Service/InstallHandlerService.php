<?php
namespace Acl\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Acl\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'acl';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Acl';
}