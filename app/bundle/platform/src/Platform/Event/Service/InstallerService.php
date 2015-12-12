<?php
namespace Platform\Event\Service;

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
    protected $exportKey = 'module_platform_event';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_event',
        'platform_event_category'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Event',
        'app/template/default/platform/event',
        'app/theme/default/sass/platform/event',
        'app/theme/admin/sass/platform/event',
        'static/jscript/platform/event'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_event'
    ];
}