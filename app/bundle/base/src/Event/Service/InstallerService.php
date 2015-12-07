<?php

/* code generator */

namespace Event\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Event\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-event';

    /**
     * @var array
     */
    protected $tableList = [
        'event',
        'event_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Event',
        'app/template/default/base/event',
        'app/theme/default/sass/base/event',
        'app/theme/admin/sass/base/event',
        'static/jscript/base/event'
    ];
}