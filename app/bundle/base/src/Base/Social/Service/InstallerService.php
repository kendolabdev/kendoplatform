<?php

/* code generator */

namespace Base\Social\Service;

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
    protected $exportKey = 'module-base-social';

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
        'app/template/default/base/Social',
        'app/theme/default/sass/base/Social',
        'app/theme/admin/sass/base/Social',
        'static/jscript/base/Social'
    ];
}