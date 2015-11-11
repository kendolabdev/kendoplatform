<?php
namespace Captcha\Service;

use Picaso\Application\ModuleInstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Captcha\Service
 */
class InstallHandlerService extends ModuleInstallHandler
{

    /**
     * @var string
     */
    protected $moduleName = 'captcha';

    /**
     * @var string
     */
    protected $sourcePath = '/base/src/Captcha';
}
