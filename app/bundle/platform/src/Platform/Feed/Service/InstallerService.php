<?php
namespace Platform\Feed\Service;

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
    protected $exportKey = 'module_platform_feed';

    /**
     * @var array
     */
    protected $tableList = [
        'platform_feed',
        'platform_feed_hash',
        'platform_feed_hashtag',
        'platform_feed_hidden',
        'platform_feed_status',
        'platform_feed_stream',
        'platform_feed_type'
    ];

    /**
     * @var array
     */
    protected $pathList = [
        'app/bundle/platform/src/Platform/Feed',
        'app/template/default/platform/feed',
        'app/theme/default/sass/platform/feed',
        'app/theme/admin/sass/platform/feed',
        'static/jscript/platform/feed'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'platform_feed'
    ];
}