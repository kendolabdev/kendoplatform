<?php

/* code generator */

namespace Platform\Payment\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-platform-payment';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_payment_currency',
        'platform_payment_gateway'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Payment',
        'app/template/default/platform/Payment',
        'app/theme/default/sass/platform/Payment',
        'app/theme/admin/sass/platform/Payment',
        'static/jscript/platform/Payment'
    ];
}