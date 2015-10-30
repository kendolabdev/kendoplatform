<?php
namespace User\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package User\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'user';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/User';
}