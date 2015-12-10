<?php

/* code generator */

namespace Platform\Notification\Service;

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
    protected $exportKey = 'module-platform-notification';

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
        'app/template/default/platform/Notification',
        'app/theme/default/sass/platform/Notification',
        'app/theme/admin/sass/platform/Notification',
        'static/jscript/platform/Notification'
    ];
}