<?php
namespace Platform\Comment\Service;

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
    protected $exportKey = 'module_platform_comment';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_comment'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Comment',
        'app/template/default/platform/comment',
        'app/theme/default/sass/platform/comment',
        'app/theme/admin/sass/platform/comment',
        'static/jscript/platform/comment'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_comment'
    ];
}