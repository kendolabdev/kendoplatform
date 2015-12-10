<?php

/* code generator */

namespace Base\Message\Service;

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
    protected $exportKey = 'module-base-message';

    /**
     * @var array
     */
    protected $tableList = [
        'base_message_conversation',
        'base_message_message',
        'base_message_recipient'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Message',
        'app/template/default/base/Message',
        'app/theme/default/sass/base/Message',
        'app/theme/admin/sass/base/Message',
        'static/jscript/base/Message'
    ];
}