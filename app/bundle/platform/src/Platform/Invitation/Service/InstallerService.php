<?php
namespace Platform\Invitation\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_platform_invitation';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_invitation',
        'platform_invitation_type'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Invitation',
        'app/template/default/platform/invitation',
        'app/theme/default/sass/platform/invitation',
        'app/theme/admin/sass/platform/invitation',
        'static/jscript/platform/invitation'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_invitation'
    ];
}