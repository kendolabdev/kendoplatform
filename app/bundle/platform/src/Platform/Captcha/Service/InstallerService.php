<?php
namespace Platform\Captcha\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_platform_captcha';

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
        'app/template/default/platform/captcha',
        'app/theme/default/sass/platform/captcha',
        'app/theme/admin/sass/platform/captcha',
        'static/jscript/platform/captcha'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_captcha'
    ];
}