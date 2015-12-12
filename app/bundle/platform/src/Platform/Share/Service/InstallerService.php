<?php
namespace Platform\Share\Service;

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
    protected $exportKey = 'module_base_share';

    /**
     * @var array
     */
    protected $tableList = [
        'base_share'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Share',
        'app/template/default/base/share',
        'app/theme/default/sass/base/share',
        'app/theme/admin/sass/base/share',
        'static/jscript/base/share'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_share'
    ];
}