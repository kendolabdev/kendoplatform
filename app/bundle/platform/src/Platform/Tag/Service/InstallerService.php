<?php
namespace Platform\Tag\Service;

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
    protected $exportKey = 'module_base_tag';

    /**
     * @var array
     */
    protected $tableList = [
        'base_tag_people'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Tag',
        'app/template/default/base/tag',
        'app/theme/default/sass/base/tag',
        'app/theme/admin/sass/base/tag',
        'static/jscript/base/tag'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_tag'
    ];
}