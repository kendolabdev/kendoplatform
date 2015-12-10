<?php

/* code generator */

namespace Platform\Invitation\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-platform-invitation';

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
        'app/template/default/platform/Invitation',
        'app/theme/default/sass/platform/Invitation',
        'app/theme/admin/sass/platform/Invitation',
        'static/jscript/platform/Invitation'
    ];
}