<?php
namespace Base\Blog\Service;

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
    protected $exportKey = 'module_base_blog';

    /**
     * @var array
     */
    protected $tableList = [
        'base_blog_category',
        'base_blog_post'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Blog',
        'app/template/default/base/blog',
        'app/theme/default/sass/base/blog',
        'app/theme/admin/sass/base/blog',
        'static/jscript/base/blog'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_blog'
    ];
}