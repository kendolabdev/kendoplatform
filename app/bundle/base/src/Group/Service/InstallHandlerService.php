<?php
namespace Group\Service;

use Picaso\Application\InstallHandler;


/**
 * Class InstallHandlerService
 *
 * @package Group\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'group';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Group';
}