<?php

/* code generator */

namespace Platform\Captcha\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-platform-captcha';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_captcha_adapter'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Captcha',
        'app/template/default/platform/Captcha',
        'app/theme/default/sass/platform/Captcha',
        'app/theme/admin/sass/platform/Captcha',
        'static/jscript/platform/Captcha'
    ];
}