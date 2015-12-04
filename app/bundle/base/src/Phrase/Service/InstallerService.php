<?php

/* code generator */

namespace Phrase\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Phrase\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-phrase';

    /**
     * @var array
     */
    protected $tableList = [
        'phrase',
        'phrase_language',
        'phrase_value'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Phrase',
        'app/template/default/base/phrase',
        'app/theme/default/sass/base/phrase',
        'app/theme/admin/sass/base/phrase',
        'static/jscript/base/phrase'
    ];
}