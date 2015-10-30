<?php
namespace Page\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Page\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'page';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Page';
}