<?php
namespace Platform\Notification\Service;

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
    protected $exportKey = 'module_platform_notification';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_notification',
        'platform_notification_subscribe',
        'platform_notification_type'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Notification',
        'app/template/default/platform/notification',
        'app/theme/default/sass/platform/notification',
        'app/theme/admin/sass/platform/notification',
        'static/jscript/platform/notification'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_notification'
    ];
}