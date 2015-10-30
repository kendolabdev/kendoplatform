<?php
namespace Follow\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Follow\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'follow';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Follow';
}