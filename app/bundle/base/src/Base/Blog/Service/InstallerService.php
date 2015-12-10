<?php

/* code generator */

namespace Base\Blog\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Base\Service
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
        'base_blog_category',
        'base_blog_post'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Blog',
        'app/template/default/base/Blog',
        'app/theme/default/sass/base/Blog',
        'app/theme/admin/sass/base/Blog',
        'static/jscript/base/Blog'
    ];
}