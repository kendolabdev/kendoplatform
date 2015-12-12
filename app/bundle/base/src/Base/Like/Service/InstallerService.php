<?php
namespace Base\Like\Service;

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
    protected $exportKey = 'module_base_like';

    /**
     * @var array
     */
    protected $tableList = [
        'base_like'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Like',
        'app/template/default/base/like',
        'app/theme/default/sass/base/like',
        'app/theme/admin/sass/base/like',
        'static/jscript/base/like'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_like'
    ];
}