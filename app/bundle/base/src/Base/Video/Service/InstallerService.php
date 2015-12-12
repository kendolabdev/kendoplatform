<?php
namespace Base\Video\Service;

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
    protected $exportKey = 'module_base_video';

    /**
     * @var array
     */
    protected $tableList = [
        'base_video',
        'base_video_category',
        'base_video_playlist',
        'base_video_playlist_video'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Video',
        'app/template/default/base/video',
        'app/theme/default/sass/base/video',
        'app/theme/admin/sass/base/video',
        'static/jscript/base/video'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_video'
    ];
}