<?php
namespace Platform\Mail\Service;

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
    protected $exportKey = 'module_platform_mail';

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
        'app/template/default/platform/mail',
        'app/theme/default/sass/platform/mail',
        'app/theme/admin/sass/platform/mail',
        'static/jscript/platform/mail'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_mail'
    ];
}