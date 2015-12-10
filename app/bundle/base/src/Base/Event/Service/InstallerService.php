<?php

/* code generator */

namespace Base\Event\Service;

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
    protected $exportKey = 'module-base-event';

    /**
     * @var array
     */
    protected $tableList = [
        'base_event',
        'base_event_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Event',
        'app/template/default/base/Event',
        'app/theme/default/sass/base/Event',
        'app/theme/admin/sass/base/Event',
        'static/jscript/base/Event'
    ];
}