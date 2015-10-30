<?php
namespace Event\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Event\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'event';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Event';
}