<?php
namespace Feed\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Feed\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'feed';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Feed';
}