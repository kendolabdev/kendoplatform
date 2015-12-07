<?php

/* code generator */

namespace Acl\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Acl\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-acl';

    /**
     * @var array
     */
    protected $tableList = [
        'acl_action',
        'acl_allow',
        'acl_group',
        'acl_role'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Acl',
        'app/template/default/base/acl',
        'app/theme/default/sass/base/acl',
        'app/theme/admin/sass/base/acl',
        'static/jscript/base/acl'
    ];
}