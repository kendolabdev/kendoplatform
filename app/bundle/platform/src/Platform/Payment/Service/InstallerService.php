<?php
namespace Platform\Payment\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Code generator
 *
 * Class InstallerService
 *
 * @package Platform\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module_platform_payment';

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
        'app/template/default/platform/payment',
        'app/theme/default/sass/platform/payment',
        'app/theme/admin/sass/platform/payment',
        'static/jscript/platform/payment'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_payment'
    ];
}