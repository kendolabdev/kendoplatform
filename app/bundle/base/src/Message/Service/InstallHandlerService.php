<?php
namespace Message\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Message\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'message';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Message';
}