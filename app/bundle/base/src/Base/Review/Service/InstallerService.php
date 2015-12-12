<?php
namespace Base\Review\Service;

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
    protected $exportKey = 'module_base_review';

    /**
     * @var array
     */
    protected $tableList = [
        'base_review'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Review',
        'app/template/default/base/review',
        'app/theme/default/sass/base/review',
        'app/theme/admin/sass/base/review',
        'static/jscript/base/review'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_review'
    ];
}