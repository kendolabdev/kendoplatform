<?php

/* code generator */

namespace Captcha\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Captcha\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-captcha';

    /**
     * @var array
     */
    protected $tableList = [
        'captcha_adapter'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Captcha',
        'app/template/default/base/captcha',
        'app/theme/default/sass/base/captcha',
        'app/theme/admin/sass/base/captcha',
        'static/jscript/base/captcha'
    ];
}