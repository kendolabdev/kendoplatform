<?php
namespace Platform\Photo\Service;

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
    protected $exportKey = 'module_platform_photo';

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
        'app/template/default/platform/photo',
        'app/theme/default/sass/platform/photo',
        'app/theme/admin/sass/platform/photo',
        'static/jscript/platform/photo'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_photo'
    ];
}