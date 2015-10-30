<?php
namespace Blog\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Blog\Service
 */
class InstallHandlerService extends InstallHandler
{

    /**
     * @var string
     */
    protected $moduleName = 'blog';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Blog';
}