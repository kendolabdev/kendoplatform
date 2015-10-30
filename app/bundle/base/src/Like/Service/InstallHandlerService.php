<?php
namespace Like\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Like\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'like';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Like';
}