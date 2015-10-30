<?php
namespace Link\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Link\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'link';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Link';
}