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
    protected $exportKey = 'module_base_message';

    /**
     * @var array
     */
    protected $tableList = [
        'base_message',
        'base_message_conversation',
        'base_message_recipient'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Message',
        'app/template/default/base/message',
        'app/theme/default/sass/base/message',
        'app/theme/admin/sass/base/message',
        'static/jscript/base/message'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_message'
    ];
}