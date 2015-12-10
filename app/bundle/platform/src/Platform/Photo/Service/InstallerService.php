<?php

/* code generator */

namespace Platform\Photo\Service;

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
    protected $exportKey = 'module-platform-photo';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_photo',
        'platform_photo_album',
        'platform_photo_category',
        'platform_photo_collection',
        'platform_photo_cover'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Photo',
        'app/template/default/platform/Photo',
        'app/theme/default/sass/platform/Photo',
        'app/theme/admin/sass/platform/Photo',
        'static/jscript/platform/Photo'
    ];
}