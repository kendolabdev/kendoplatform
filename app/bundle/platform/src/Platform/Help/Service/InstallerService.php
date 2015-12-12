<?php
namespace Platform\Help\Service;

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
    protected $exportKey = 'module_base_help';

    /**
     * @var array
     */
    protected $tableList = [
        'base_help_category',
        'base_help_page',
        'base_help_post',
        'base_help_topic'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Help',
        'app/template/default/base/help',
        'app/theme/default/sass/base/help',
        'app/theme/admin/sass/base/help',
        'static/jscript/base/help'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_help'
    ];
}