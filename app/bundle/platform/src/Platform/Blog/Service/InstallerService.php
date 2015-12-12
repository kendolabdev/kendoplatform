<?php
namespace Platform\Blog\Service;

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
    protected $exportKey = 'module_platform_blog';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_blog_category',
        'platform_blog_post'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Blog',
        'app/template/default/platform/blog',
        'app/theme/default/sass/platform/blog',
        'app/theme/admin/sass/platform/blog',
        'static/jscript/platform/blog'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_blog'
    ];
}