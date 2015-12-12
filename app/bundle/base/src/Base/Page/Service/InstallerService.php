<?php
namespace Base\Page\Service;

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
    protected $exportKey = 'module_base_page';

    /**
     * @var array
     */
    protected $tableList = [
        'base_page',
        'base_page_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Page',
        'app/template/default/base/page',
        'app/theme/default/sass/base/page',
        'app/theme/admin/sass/base/page',
        'static/jscript/base/page'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_page'
    ];
}