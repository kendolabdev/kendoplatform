<?php
namespace Captcha\Service;

use Picaso\Application\InstallHandler;

/**
 * Class InstallHandlerService
 *
 * @package Captcha\Service
 */
class InstallHandlerService extends InstallHandler
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
