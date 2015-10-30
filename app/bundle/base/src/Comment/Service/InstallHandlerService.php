<?php
namespace Comment\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Comment\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'comment';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Comment';
}