<?php
namespace Help\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Help\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'help';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Help';
}