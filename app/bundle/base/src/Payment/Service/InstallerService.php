<?php

/* code generator */

namespace Payment\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Payment\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-payment';

    /**
     * @var array
     */
    protected $tableList = [
        'payment_currency',
        'payment_gateway'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Payment',
        'app/template/default/base/payment',
        'app/theme/default/sass/base/payment',
        'app/theme/admin/sass/base/payment',
        'static/jscript/base/payment'
    ];
}