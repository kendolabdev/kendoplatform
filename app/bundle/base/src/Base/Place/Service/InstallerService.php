<?php
namespace Base\Place\Service;

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
    protected $exportKey = 'module_base_place';

    /**
     * @var array
     */
    protected $tableList = [
        'base_place'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Place',
        'app/template/default/base/place',
        'app/theme/default/sass/base/place',
        'app/theme/admin/sass/base/place',
        'static/jscript/base/place'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_place'
    ];
}