<?php
namespace Photo\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Photo\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'photo';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Photo';
}