<?php
namespace Base\Link\Service;

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
    protected $exportKey = 'module_base_link';

    /**
     * @var array
     */
    protected $tableList = [
        'base_link'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Link',
        'app/template/default/base/link',
        'app/theme/default/sass/base/link',
        'app/theme/admin/sass/base/link',
        'static/jscript/base/link'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_link'
    ];
}