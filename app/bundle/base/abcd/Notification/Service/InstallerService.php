<?php

/* code generator */

namespace Notification\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Notification\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-notification';

    /**
     * @var array
     */
    protected $tableList = [
        'notification',
        'notification_subscribe',
        'notification_type'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Notification',
        'app/template/default/base/notification',
        'app/theme/default/sass/base/notification',
        'app/theme/admin/sass/base/notification',
        'static/jscript/base/notification'
    ];
}