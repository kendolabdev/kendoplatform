<?php

/* code generator */

namespace Platform\Mail\Service;

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
    protected $exportKey = 'module-platform-mail';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_mail_adapter',
        'platform_mail_item',
        'platform_mail_template',
        'platform_mail_translate',
        'platform_mail_transport'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Mail',
        'app/template/default/platform/Mail',
        'app/theme/default/sass/platform/Mail',
        'app/theme/admin/sass/platform/Mail',
        'static/jscript/platform/Mail'
    ];
}