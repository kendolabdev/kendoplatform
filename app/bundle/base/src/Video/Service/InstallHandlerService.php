<?php
namespace Video\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Video\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'video';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Video';
}