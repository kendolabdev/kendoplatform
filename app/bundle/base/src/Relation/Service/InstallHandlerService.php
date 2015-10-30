<?php
namespace Relation\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Relation\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'relation';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Relation';
}