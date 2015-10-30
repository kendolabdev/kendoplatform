<?php
namespace Core\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Core\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'core';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Core';

    /**
     *
     */
    public function _afterImport()
    {
        \App::table('core.core_uid_generator')
            ->insertIgnore(['uid' => 1000]);

    }
}