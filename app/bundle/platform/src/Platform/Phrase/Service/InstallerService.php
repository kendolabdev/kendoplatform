<?php

/* code generator */

namespace Platform\Phrase\Service;

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
    protected $exportKey = 'module-platform-phrase';

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
        'app/template/default/platform/Phrase',
        'app/theme/default/sass/platform/Phrase',
        'app/theme/admin/sass/platform/Phrase',
        'static/jscript/platform/Phrase'
    ];
}