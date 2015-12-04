<?php

/* code generator */

namespace Relation\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Relation\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-relation';

    /**
     * @var array
     */
    protected $tableList = [
        'relation',
        'relation_item',
        'relation_request',
        'relation_type'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Relation',
        'app/template/default/base/relation',
        'app/theme/default/sass/base/relation',
        'app/theme/admin/sass/base/relation',
        'static/jscript/base/relation'
    ];
}