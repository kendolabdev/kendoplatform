<?php
namespace Platform\Phrase\Service;

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
    protected $exportKey = 'module_platform_phrase';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_phrase',
        'platform_phrase_language',
        'platform_phrase_value'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Phrase',
        'app/template/default/platform/phrase',
        'app/theme/default/sass/platform/phrase',
        'app/theme/admin/sass/platform/phrase',
        'static/jscript/platform/phrase'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_phrase'
    ];
}