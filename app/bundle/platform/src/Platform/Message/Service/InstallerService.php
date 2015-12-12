<?php
namespace Platform\Message\Service;

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
    protected $exportKey = 'module_platform_message';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_message',
        'platform_message_conversation',
        'platform_message_recipient'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Message',
        'app/template/default/platform/message',
        'app/theme/default/sass/platform/message',
        'app/theme/admin/sass/platform/message',
        'static/jscript/platform/message'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_message'
    ];
}