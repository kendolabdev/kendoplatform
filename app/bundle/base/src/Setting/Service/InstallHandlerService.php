<?php
namespace Setting\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Setting\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'setting';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Setting';
}