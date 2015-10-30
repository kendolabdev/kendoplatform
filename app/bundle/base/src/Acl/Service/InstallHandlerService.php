<?php
namespace Acl\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Acl\Service
 */
class InstallHandlerService extends InstallHandler
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