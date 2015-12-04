<?php

/* code generator */

namespace Video\Service;

use Picaso\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Video\Service
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
        'video',
        'video_category',
        'video_playlist',
        'video_playlist_video'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Video',
        'app/template/default/base/video',
        'app/theme/default/sass/base/video',
        'app/theme/admin/sass/base/video',
        'static/jscript/base/video'
    ];
}