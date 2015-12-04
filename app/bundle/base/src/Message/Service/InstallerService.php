<?php

/* code generator */

namespace Message\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Message\Service
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
        'message_conversation',
        'message_message',
        'message_recipient'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Message',
        'app/template/default/base/message',
        'app/theme/default/sass/base/message',
        'app/theme/admin/sass/base/message',
        'static/jscript/base/message'
    ];
}