<?php
namespace Report\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Report\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'report';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Report';
}