<?php
namespace Search\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Search\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'search';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Search';
}