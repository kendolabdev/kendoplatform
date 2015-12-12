<?php
namespace Base\Comment\Service;

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
    protected $exportKey = 'module_base_comment';

    /**
     * @var array
     */
    protected $tableList = [
        'base_comment'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Comment',
        'app/template/default/base/comment',
        'app/theme/default/sass/base/comment',
        'app/theme/admin/sass/base/comment',
        'static/jscript/base/comment'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_comment'
    ];
}