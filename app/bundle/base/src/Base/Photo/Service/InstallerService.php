<?php
namespace Base\Photo\Service;

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
    protected $exportKey = 'module_base_photo';

    /**
     * @var array
     */
    protected $tableList = [
        
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Photo',
        'app/template/default/base/photo',
        'app/theme/default/sass/base/photo',
        'app/theme/admin/sass/base/photo',
        'static/jscript/base/photo'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_photo'
    ];
}