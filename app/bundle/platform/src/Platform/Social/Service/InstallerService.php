<?php
namespace Platform\Social\Service;

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
    protected $exportKey = 'module_base_social';

    /**
     * @var array
     */
    protected $tableList = [
        'base_social_service'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Social',
        'app/template/default/base/social',
        'app/theme/default/sass/base/social',
        'app/theme/admin/sass/base/social',
        'static/jscript/base/social'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_social'
    ];
}