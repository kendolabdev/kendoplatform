<?php
namespace Payment\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Payment\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'payment';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Payment';
}