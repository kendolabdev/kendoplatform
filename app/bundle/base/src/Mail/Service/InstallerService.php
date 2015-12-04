<?php

/* code generator */

namespace Mail\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Mail\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-mail';

    /**
     * @var array
     */
    protected $tableList = [
        'mail_adapter',
        'mail_item',
        'mail_template',
        'mail_translate',
        'mail_transport'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Mail',
        'app/template/default/base/mail',
        'app/theme/default/sass/base/mail',
        'app/theme/admin/sass/base/mail',
        'static/jscript/base/mail'
    ];
}