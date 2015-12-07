<?php

/* code generator */

namespace Feed\Service;

use Kendo\Package\ModuleInstaller;

/**
 * Class InstallerService
 *
 * @package Feed\Service
 */
class InstallerService extends ModuleInstaller
{
    /**
     * @var string
     */
    protected $exportKey = 'module-base-feed';

    /**
     * @var array
     */
    protected $tableList = [
        'feed',
        'feed_hash',
        'feed_hashtag',
        'feed_hidden',
        'feed_status',
        'feed_stream',
        'feed_type'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Feed',
        'app/template/default/base/feed',
        'app/theme/default/sass/base/feed',
        'app/theme/admin/sass/base/feed',
        'static/jscript/base/feed'
    ];
}