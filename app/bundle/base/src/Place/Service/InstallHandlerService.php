<?php
namespace Place\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Place\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'place';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Place';
}