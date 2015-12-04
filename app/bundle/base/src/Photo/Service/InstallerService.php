<?php

/* code generator */

namespace Photo\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Photo\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-photo';

    /**
     * @var array
     */
    protected $tableList = [
        'photo',
        'photo_album',
        'photo_category',
        'photo_collection',
        'photo_cover'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Photo',
        'app/template/default/base/photo',
        'app/theme/default/sass/base/photo',
        'app/theme/admin/sass/base/photo',
        'static/jscript/base/photo'
    ];
}