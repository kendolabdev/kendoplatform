<?php
namespace Tag\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Tag\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'tag';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Tag';
}