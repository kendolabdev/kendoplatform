<?php
namespace Base\Captcha\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Base\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_base_captcha';

    /**
     * @var array
     */
    protected $tableList = [
        
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Captcha',
        'app/template/default/base/captcha',
        'app/theme/default/sass/base/captcha',
        'app/theme/admin/sass/base/captcha',
        'static/jscript/base/captcha'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_captcha'
    ];
}