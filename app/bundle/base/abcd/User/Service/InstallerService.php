<?php

/* code generator */

namespace User\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package User\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-user';

    /**
     * @var array
     */
    protected $tableList = [
        'user',
        'user_attribute_value',
        'user_auth_password',
        'user_auth_remote',
        'user_token'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/User',
        'app/template/default/base/user',
        'app/theme/default/sass/base/user',
        'app/theme/admin/sass/base/user',
        'static/jscript/base/user'
    ];
}