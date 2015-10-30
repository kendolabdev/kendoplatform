<?php
namespace Attribute\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Attribute\Service
 */
class InstallHandlerService extends InstallHandler
{
    /**
     * @var string
     */
    protected $moduleName = 'attribute';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Attribute';
}