<?php
namespace Invitation\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Invitation\Service
 */
class InstallHandlerService extends InstallHandler
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