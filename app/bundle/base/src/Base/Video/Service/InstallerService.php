<?php

/* code generator */

namespace Base\Video\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Base\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-video';

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
        'app/template/default/base/Video',
        'app/theme/default/sass/base/Video',
        'app/theme/admin/sass/base/Video',
        'static/jscript/base/Video'
    ];
}