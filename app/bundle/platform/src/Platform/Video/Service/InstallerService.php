<?php
namespace Platform\Video\Service;

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
    protected $exportKey = 'module_platform_video';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_video',
        'platform_video_category',
        'platform_video_playlist',
        'platform_video_playlist_video'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Video',
        'app/template/default/platform/video',
        'app/theme/default/sass/platform/video',
        'app/theme/admin/sass/platform/video',
        'static/jscript/platform/video'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_video'
    ];
}