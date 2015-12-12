<?php
namespace Base\Feed\Service;

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
    protected $exportKey = 'module_base_feed';

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
        'app/template/default/base/feed',
        'app/theme/default/sass/base/feed',
        'app/theme/admin/sass/base/feed',
        'static/jscript/base/feed'
    ];

    /**
     * @var array
     */
    protected $moduleList = [
        'base_feed'
    ];
}