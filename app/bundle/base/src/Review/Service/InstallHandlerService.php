<?php
namespace Review\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Review\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'review';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Review';
}