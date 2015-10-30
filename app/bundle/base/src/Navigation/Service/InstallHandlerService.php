<?php
namespace Navigation\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Navigation\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'navigation';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Navigation';
}