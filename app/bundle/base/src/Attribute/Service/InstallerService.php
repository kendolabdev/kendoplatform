<?php

/* code generator */

namespace Attribute\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Attribute\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-attribute';

    /**
     * @var array
     */
    protected $tableList = [
        'attribute_catalog',
        'attribute_field',
        'attribute_field_map',
        'attribute_option',
        'attribute_plugin',
        'attribute_section',
        'attribute_section_map'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Attribute',
        'app/template/default/base/attribute',
        'app/theme/default/sass/base/attribute',
        'app/theme/admin/sass/base/attribute',
        'static/jscript/base/attribute'
    ];
}