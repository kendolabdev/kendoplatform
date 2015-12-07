<?php

/* code generator */

namespace Invitation\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Invitation\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-invitation';

    /**
     * @var array
     */
    protected $tableList = [
        'invitation',
        'invitation_type'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Invitation',
        'app/template/default/base/invitation',
        'app/theme/default/sass/base/invitation',
        'app/theme/admin/sass/base/invitation',
        'static/jscript/base/invitation'
    ];
}