<?php

/* code generator */

namespace Blog\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Blog\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-blog';

    /**
     * @var array
     */
    protected $tableList = [
        'blog_category',
        'blog_post'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Blog',
        'app/template/default/base/blog',
        'app/theme/default/sass/base/blog',
        'app/theme/admin/sass/base/blog',
        'static/jscript/base/blog'
    ];
}