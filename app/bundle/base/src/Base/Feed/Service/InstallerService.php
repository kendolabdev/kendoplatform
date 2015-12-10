<?php

/* code generator */

namespace Base\Feed\Service;

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
    protected $exportKey = 'module-base-feed';

    /**
     * @var array
     */
    protected $tableList = [
        'base_feed',
        'base_feed_hash',
        'base_feed_hashtag',
        'base_feed_hidden',
        'base_feed_status',
        'base_feed_stream',
        'base_feed_type'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/base/src/Base/Feed',
        'app/template/default/base/Feed',
        'app/theme/default/sass/base/Feed',
        'app/theme/admin/sass/base/Feed',
        'static/jscript/base/Feed'
    ];
}