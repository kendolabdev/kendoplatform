<?php
namespace Platform\Follow\Service;

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
    protected $exportKey = 'module_base_follow';

    /**
     * @var array
     */
    protected $tableList = [
        'base_follow'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Follow',
        'app/template/default/base/follow',
        'app/theme/default/sass/base/follow',
        'app/theme/admin/sass/base/follow',
        'static/jscript/base/follow'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_follow'
    ];
}