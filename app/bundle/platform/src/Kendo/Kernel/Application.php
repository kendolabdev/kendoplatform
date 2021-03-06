<?php
namespace Kendo\Kernel;

/**
 * Class Application
 *
 * @package Kendo\Kernel
 *
 */
class Application
{
    /**
     * Version base
     */
    const VERSION = '4.1.0';

    /**
     * @var Application
     */
    public static $app;

    /**
     * @var array
     */
    private $byInstances = [];

    /**
     * @var array
     */
    private $byNames = [];

    /**
     * @var bool
     */
    private $unitest = false;

    /**
     * @var bool
     */
    private $hasStarted = false;

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var array
     */
    private $startByNames = [
        'autoload',
        'profiler',
        'db',
        'cache',
        'log',
        'packages',
        'settings',
        'resource',
        'hook',
        'auth',
    ];

    /**
     * array
     */
    private $requires = [
        'resource'    => '\Kendo\Resources\ResourcesContainer',
        'settings'    => '\Kendo\Settings\SettingsContainer',
        'autoload'    => '\Kendo\Kernel\ClassAutoload',
        'packages'    => '\Kendo\Package\PackageManager',
        'db'          => '\Kendo\Db\DbManager',
        'cache'       => '\Kendo\Cache\CacheManager',
        'log'         => '\Kendo\Log\Manager',
        'hook'        => '\Kendo\Hook\EventManager',
        'upload'      => '\Kendo\Upload\UploadManager',
        'routing'     => '\Kendo\Routing\RoutingManager',
        'i18n'        => '\Kendo\I18n\Manager',
        'phrase'      => '\Platform\Phrase\Service\PhraseService',
        'acl'         => '\Platform\Acl\Service\AclService',
        'help'        => '\Platform\Help\Service\HelpService',
        'setting'     => '\Platform\Setting\Service\SettingService',
        'requester'   => '\Kendo\Http\RequestManager',
        'pusher'      => '\Kendo\PushNotification\Manager',
        'view_finder' => '\Kendo\View\ViewFinder',
        'view_helper' => '\Kendo\View\ViewHelper',
        'assets'      => '\Kendo\Assets\AssetsManager',
        'navigation'  => '\Kendo\Navigation\Manager',
        'html'        => '\Kendo\Html\Manager',
        'layout'      => '\Platform\Layout\Service\LayoutService',
        'registry'    => '\Kendo\Registry\Manager',
        'image'       => '\Kendo\Image\ImageManager',
        'storage'     => '\Platform\Storage\Service\StorageService',
        'auth'        => '\Kendo\Auth\AuthManager',
        'user'        => '\Platform\User\Service\UserService',
        'relation'    => '\Platform\Relation\Service\RelationService',
        'paging'      => '\Kendo\Paging\Manager',
        'validator'   => '\Kendo\Validator\Manager',
        'sass'        => '\Kendo\Sass\Manager',
        'session'     => '\Kendo\Session\Manager',
        'twig'        => '\Kendo\Twig\Manager',
        'profiler'    => '\Kendo\Profiler\ProfilerContainer',
        'uid'         => '\Kendo\Kernel\UniqueIdProvider',
    ];


    /**
     * @var array
     */
    static public $cachedItem = [];


    /**
     * Prevent public construct
     */
    public function __construct()
    {
        $this->byNames = [];
    }

    /**
     * @return string
     */
    public static function version()
    {
        return self::VERSION;
    }

    /**
     * @return \Kendo\Kernel\Application
     */
    public static function instance()
    {
        if (null == self::$app) {
            self::$app = new self;
        }

        return self::$app;
    }

    /**
     * reset all service
     */
    public function reset()
    {
        $this->byInstances = [];
        $this->start();
    }

    /**
     * @param string $name Service Alias
     *
     * @return KernelServiceInterface
     * @throws \InvalidArgumentException
     */
    private function create($name)
    {
        $class = $this->normalizeClassName($name);

        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Missing class " . $class);
        }

        $maker = new $class();

        if (!$maker instanceof KernelServiceInterface) {
            throw new \InvalidArgumentException(sprintf('Unexpected service "%s"', $name));
        }

        $this->byInstances[ $name ] = $maker->bind($this);

        $maker->bound();

        return $this->byInstances[ $name ];
    }

    /**
     * @param string $name
     *
     * @return KernelServiceInterface
     */
    public function make($name)
    {
        return isset($this->byInstances[ $name ]) ? $this->byInstances[ $name ] : $this->create($name);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        if (isset($this->byNames[ $name ]))
            return true;

        if (isset($this->requires[ $name ]))
            return true;

        $class = $this->normalizeClassName($name);

        if (class_exists($class))
            return true;

        return false;
    }

    /**
     * @param  string $name
     *
     * @return string
     * @throws KernelException
     */
    private function normalizeClassName($name)
    {
        if (!empty($this->requires[ $name ])) {
            return $this->requires[ $name ];
        }

        if (!empty($this->byNames[ $name ])) {
            return $this->byNames[ $name ];
        }

        $arr = explode('_', $name, 3);

        $vendor = ucfirst($arr[0]);
        $module = ucfirst($arr[1]);


        if (count($arr) == 2) {
            return '\\' . $vendor . "\\{$module}\\Service\\{$module}Service";
        }

        return '\\' . $vendor . '\\' . $module . '\\Service\\' . str_replace(' ', '', ucwords(str_replace(['.', '_'], ['\Service\ ', ' '], $arr[2]))) . 'Service';

    }

    /**
     * Register a service
     *
     * @param string $name
     * @param string $className
     */
    public function register($name, $className)
    {
        $this->byNames[ $name ] = $className;
    }

    /**
     * Start service
     */
    public function start()
    {
        if ($this->hasStarted) {
            return;
        }

        /**
         * Change status
         */
        $this->hasStarted = true;

        /**
         * Init service we need to force start
         */
        foreach ($this->startByNames as $name) {
            $this->make($name);
        }
    }

    /**
     * @return boolean
     */
    public function isUnitest()
    {
        return $this->unitest;
    }

    /**
     * @param boolean $unitest
     */
    public function setUnitest($unitest)
    {
        $this->unitest = $unitest;
    }


    /**
     * @return string
     */
    public static function staticBaseUrl()
    {
        $staticUrl = app()->setting('core', 'static_base_url');

        if (!$staticUrl OR defined('KENDO_DEVELOPMENT') && KENDO_DEVELOPMENT) {
            $staticUrl = KENDO_BASE_URL;
        }

        return $staticUrl;

    }

    /**
     * @return \Platform\Invitation\Service\InvitationService
     *
     */
    public static function invitationService()
    {
        return self::$app->make('platform_invitation');
    }

    /**
     * @return \Platform\Notification\Service\NotificationService
     */
    public static function notificationService()
    {
        return self::$app->make('platform_notification');
    }

    /**
     * @return \Platform\Message\Service\MessageService
     */
    public static function messageService()
    {
        return self::$app->make('platform_message');
    }

    /**
     * @param $name
     *
     * @return \Kendo\Kernel\KernelServiceInterface
     */
    public static function service($name)
    {
        return self::$app->make($name);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public static function hasService($name)
    {
        return self::$app->has($name);
    }

    /**
     * @return \Platform\Feed\Service\FeedService
     */
    public static function feedService()
    {
        return self::$app->make('platform_feed');
    }

    /**
     * @return \Platform\Tag\Service\TagService
     */
    public static function tagService()
    {
        return self::$app->make('platform_tag');
    }


    /**
     * @return \Platform\Mail\Service\MailService
     */
    public static function mailService()
    {
        return self::$app->make('platform_mail');
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    public static function toSlug($string)
    {
        return preg_replace('/(\s+)/', '-', $string);
    }


    /**
     * Convert string to underscore case
     *
     * @param $string
     *
     * @return string
     */
    public static function underscore($string)
    {
        return strtolower(trim(preg_replace('/([a-z0-9])([A-Z])/', '\1_\2', $string), '-. '));
    }

    /**
     * @return \Platform\Acl\Service\AclService
     */
    public static function aclService()
    {
        return self::$app->make('platform_acl');
    }

    /**
     * @return \Kendo\Kernel\ClassAutoload
     */
    public static function autoload()
    {
        return self::$app->make('autoload');
    }

    /**
     * @return \Kendo\Cache\CacheManager
     */
    public static function cacheService()
    {
        return self::$app->make('cache');

    }

    /**
     * @return \Kendo\Log\Manager
     */
    public static function logService()
    {
        return self::$app->make('log');
    }

    /**
     * @return \Platform\Storage\Service\StorageService
     */
    public static function storageService()
    {
        return self::$app->make('storage');
    }

    /**
     * @usages app()->table('platform_user') <br />
     *
     * @param string $alias
     *
     * @return \Kendo\Db\DbTable
     */
    public static function table($alias)
    {
        return self::resources()->make($alias);
    }

    /**
     * @return \Kendo\Resources\ResourcesContainer
     */
    public static function resources()
    {
        return self::$app->make('resource');
    }

    /**
     * @return \Platform\Link\Service\LinkService
     */
    public static function linkService()
    {
        return self::$app->make('platform.link');
    }

    /**
     * @return \Platform\Blog\Service\BlogService
     */
    public static function blogService()
    {
        return self::$app->make('platform_blog');
    }

    /**
     * @return \Platform\Core\Service\CoreService
     */
    public static function coreService()
    {
        return self::$app->make('platform_core');
    }

    /**
     * @return \Platform\Group\Service\GroupService
     */
    public static function groupService()
    {
        return self::$app->make('platform_group');
    }

    /**
     * @return \Platform\Video\Service\VideoService
     */
    public static function videoService()
    {
        return self::$app->make('platform_video');
    }

    /**
     * @return \Platform\Photo\Service\PhotoService
     */
    public static function photoService()
    {
        return self::$app->make('platform_photo');
    }

    /**
     * @return \Platform\Page\Service\PageService
     */
    public static function pageService()
    {
        return self::$app->make('platform_page');
    }

    /**
     * @return \Platform\Event\Service\EventService
     */
    public static function eventService()
    {
        return self::$app->make('platform_event');
    }


    /**
     * Shortcut to get global setting
     *
     * @param string $group
     * @param string $name
     * @param null   $defaultValue
     *
     * @return mixed
     */
    public function setting($group, $name = null, $defaultValue = null)
    {
        return $this->settings()->get($group, $name, $defaultValue);
    }

    /**
     * @return \Platform\Captcha\Service\CaptchaService
     */
    public static function captcha()
    {
        return self::$app->make('platform_captcha');
    }


    /**
     * Get content from database table has single primary key.
     *
     * @param string $tid Global Type Id
     * @param string $gid Global Unique Id
     *
     * @return \Kendo\Content\ContentInterface
     * @throws \Exception
     */
    public static function find($tid, $gid)
    {
        if (empty($tid) or empty($gid)) {
            return null;
        }
        try {
            return self::resources()->make($tid)->findById($gid);
        } catch (\Exception $ex) {
            if (self::instance()->isDebug()) {
                throw $ex;
            }
        }

        return null;
    }

    /**
     * @return \Platform\Help\Service\HelpService
     */
    public static function helpService()
    {
        return self::$app->make('platform_help');
    }

    /**
     * @return \Platform\Like\Service\LikeService
     */
    public static function likeService()
    {
        return self::$app->make('platform_like');
    }

    /**
     * @return \Platform\Follow\Service\FollowService
     */
    public static function followService()
    {
        return self::$app->make('platform_follow');
    }

    /**
     * @return \Platform\Phrase\Service\PhraseService
     */
    public static function phraseService()
    {
        return self::$app->make('platform_phrase');
    }

    /**
     * @return \Platform\Comment\Service\CommentService
     */
    public static function commentService()
    {
        return self::$app->make('platform_comment');
    }

    /**
     * @return \Platform\Search\Service\SearchService
     */
    public function searchService()
    {
        return self::$app->make('platform_search');
    }

    /**
     * @return \Platform\Share\Service\ShareService
     */
    public static function shareService()
    {
        return self::$app->make('platform_share');
    }

    /**
     * @return \Kendo\Hook\EventManager
     */
    public static function emitter()
    {
        return self::$app->make('hook');
    }

    /**
     * @return \Kendo\View\ViewFinder
     */
    public static function viewFinder()
    {
        return self::$app->make('view_finder');
    }

    /**
     * @return \Kendo\Routing\RoutingManager
     */
    public static function routing()
    {
        return self::$app->make('routing');
    }

    /**
     * @return \Kendo\View\ViewHelper
     */
    public static function viewHelper()
    {
        return self::$app->make('view_helper');
    }

    /**
     * @return \Kendo\I18n\Translator
     */
    public static function trans()
    {
        return self::i18n()->getTranslator();
    }

    /**
     * @return \Kendo\I18n\Manager
     */
    public static function i18n()
    {
        return self::$app->make('i18n');
    }

    /**
     * @return \Kendo\Assets\AssetsManager
     */
    public static function assetService()
    {
        return self::$app->make('assets');
    }

    /**
     * @return \Kendo\Navigation\Manager
     */
    public static function navigation()
    {
        return self::$app->make('navigation');
    }

    /**
     * @return \Kendo\Html\Manager
     */
    public static function html()
    {
        return self::$app->make('html');
    }

    /**
     * @param       $msgId
     * @param array $data
     * @param int   $count
     *
     * @return string
     */
    public static function text($msgId, $data = null, $count = null)
    {
        if (defined('KENDO_INSTALLATION'))
            return $msgId;

        return self::i18n()->getTranslator()->text($msgId, $data, $count);
    }

    /**
     * @return \Platform\Layout\Service\LayoutService
     */
    public static function layouts()
    {
        return self::$app->make('platform_layout');
    }

    /**
     * @return \Kendo\Registry\Manager
     */
    public static function registryService()
    {
        return self::$app->make('registry');
    }


    /**
     * Get Poster Value settings. It is used for "Parent" content only
     *
     * @param        $parent
     * @param string $name
     * @param null   $defaultValue
     *
     * @return mixed
     */
    public static function value($parent, $name, $defaultValue = null)
    {
        return self::values()->getValue($parent, $name, $defaultValue);
    }

    /**
     * @return \Platform\Core\Service\ValueService
     */
    public static function values()
    {
        return self::$app->make('core.value');
    }


    /**
     * @return \Kendo\Validator\Manager
     */
    public static function validation()
    {
        return self::$app->make('validator');
    }


    /**
     * @return \Platform\Relation\Service\RelationService
     */
    public static function relation()
    {
        return self::$app->make('relation');
    }

    /**
     * @return \Kendo\Sass\Manager
     */
    public static function sass()
    {
        return self::$app->make('sass');
    }

    /**
     * @return \Platform\Social\Service\SocialService
     */
    public static function socialService()
    {
        return self::$app->make('platform_social');
    }

    /**
     * @return \Platform\Catalog\Service\CatalogService
     */
    public static function catalogService()
    {
        return self::$app->make('attribute');
    }

    /**
     * @return \Kendo\Profiler\ProfilerContainer
     */
    public static function profiler()
    {
        return self::$app->make('profiler');
    }


    /**
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param boolean $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @return \Kendo\Image\InterventionManager
     */
    public function image()
    {
        return $this->make('image');
    }

    /**
     * @return \Platform\User\Service\UserService
     */
    public function user()
    {
        return $this->make('user');
    }

    /**
     * @return \Platform\Report\Service\ReportService
     */
    public function report()
    {
        return $this->make('platform_report');
    }

    /**
     * @return \Kendo\Settings\SettingsContainer
     */
    public function settings()
    {
        return $this->make('settings');
    }

    /**
     * @return \Kendo\Paging\Manager
     */
    public function paging()
    {
        return $this->make('paging');
    }

    /**
     * @return \Kendo\Session\Manager
     */
    public function session()
    {
        return $this->make('session');

    }

    /**
     * @return \Kendo\Twig\Manager
     */
    public function twig()
    {
        return $this->make('twig');
    }

    /**
     * @return \Kendo\Db\DbManager
     */
    public function db()
    {
        return $this->make('db');
    }

    /**
     * @return \Kendo\Auth\AuthManager
     */
    public function auth()
    {
        return $this->make('auth');
    }

    /**
     * @return \Kendo\Http\RequestManager
     */
    public function requester()
    {
        return $this->make('requester');
    }

    /**
     * @return \Kendo\Package\PackageManager
     */
    public function packages()
    {
        return $this->make('packages');
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return \Kendo\Kernel\KernelServiceInterface
     */
    function __call($name, $arguments)
    {
        return isset($this->byInstances[ $name ]) ? $this->byInstances[ $name ] : $this->create($name);
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return KernelServiceInterface
     */
    public static function __callStatic($name, $arguments)
    {
        return self::$app->make($name);
    }
}