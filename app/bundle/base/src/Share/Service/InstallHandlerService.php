<?php
namespace Share\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Share\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'share';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Share';
}