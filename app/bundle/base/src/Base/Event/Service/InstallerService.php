<?php
namespace Base\Event\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Base\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_base_event';

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
        'app/template/default/base/event',
        'app/theme/default/sass/base/event',
        'app/theme/admin/sass/base/event',
        'static/jscript/base/event'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_event'
    ];
}