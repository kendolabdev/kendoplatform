<?php

/**
 * Class App
 */
class App
{
    /**
     * Version base
     */
    const VERSION = '4.1.0';

    /**
     * @var \Kendo\ServiceManager
     */
    static public $manager;

    /**
     * @var array
     */
    static public $cachedItem = [];

    /**
     * @return string
     */
    public static function version()
    {
        return self::VERSION;
    }

    /**
     * @return string
     */
    public static function staticBaseUrl()
    {
        $staticUrl = \App::setting('core', 'static_base_url');

        if (!$staticUrl OR defined('KENDO_DEVELOPMENT') && KENDO_DEVELOPMENT) {
            $staticUrl = KENDO_BASE_URL;
        }

        return $staticUrl;

    }

    /**
     * @return \Kendo\Application\Manager
     */
    public static function extensions()
    {
        return self::$manager->getService('app');
    }

    /**
     * @return \Platform\Invitation\Service\InvitationService
     */
    public static function invitationService()
    {
        return self::$manager->getService('invitation');
    }

    /**
     * @return \Platform\Notification\Service\NotificationService
     */
    public static function notificationService()
    {
        return self::$manager->getService('notification');
    }

    /**
     * @return \Platform\Message\Service\MessageService
     */
    public static function messageService()
    {
        return App::service('message');
    }

    /**
     * @param $name
     *
     * @return
     */
    public static function service($name)
    {
        return self::$manager->getService($name);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public static function hasService($name)
    {
        return self::$manager->hasService($name);
    }

    /**
     * @return \Platform\Feed\Service\FeedService
     */
    public static function feedService()
    {
        return self::$manager->getService('feed');
    }

    /**
     * @return \Platform\Tag\Service\TagService
     */
    public static function tagService()
    {
        return self::$manager->getService('tag');
    }

    /**
     * @return \Kendo\Twig\Manager
     */
    public static function twig()
    {
        return self::$manager->getService('twig');
    }

    /**
     * init loader once
     */
    public static function load()
    {

        if (null == self::$manager) {

            // init autoload
            \Kendo\Autoload\Manager::getInstance();

            // init service manager
            self::$manager = new \Kendo\ServiceManager();

            self::$manager->getService('app')->bootstrap();
        }
    }

    /**
     * @return \Platform\Mail\Service\MailService
     */
    public static function mailService()
    {
        return \App::$manager->getService('mail');
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
     * @param $string
     *
     * @return mixed
     */
    public static function inflect($string)
    {
        return str_replace(' ', '', ucwords(str_replace(['.', '-'], ' ', $string)));
    }

    /**
     * @param $string
     *
     * @return string
     */
    public static function deflect($string)
    {
        return strtolower(trim(preg_replace('/([a-z0-9])([A-Z])/', '\1-\2', $string), '-. '));
    }

    /**
     * Convert string from callmel case to underscore case
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
        return self::$manager->getService('platform_acl');
    }

    /**
     * @return \Kendo\Db\Manager
     */
    public static function db()
    {
        return self::$manager->getService('db');
    }

    /**
     * @return \Kendo\Session\Manager
     */
    public static function sessionService()
    {
        return self::$manager->getService('session');
    }

    /**
     * @return \Kendo\Paging\Manager
     */
    public static function pagingService()
    {
        return self::$manager->getService('paging');
    }

    /**
     * @return \Kendo\Autoload\Manager
     */
    public static function autoload()
    {
        return self::$manager->getService('autoload');
    }

    /**
     * @return \Kendo\Cache\Manager
     */
    public static function cacheService()
    {
        return self::$manager->getService('cache');

    }

    /**
     * @return \Kendo\Log\Manager
     */
    public static function logService()
    {
        return self::$manager->getService('log');
    }

    /**
     * @return \Platform\Storage\Service\StorageService
     */
    public static function storageService()
    {
        return self::$manager->getService('storage');
    }

    /**
     * @usages \App::table('platform_user') <br />
     * If you want to use full class name, use \App::db()->table('\User\Model\User')
     *
     * @param string $alias
     *
     * @return \Kendo\Db\DbTable
     */
    public static function table($alias)
    {
        return self::contentService()->getTable($alias);
    }

    /**
     * @return \Kendo\Content\Manager
     */
    public static function contentService()
    {
        return self::$manager->getService('content');
    }

    /**
     * @return \Platform\Link\Service\LinkService
     */
    public static function linkService()
    {
        return self::$manager->getService('platform.link');
    }

    /**
     * @return \Platform\Blog\Service\BlogService
     */
    public static function blogService()
    {
        return self::$manager->getService('base_blog');
    }

    /**
     * @return \Platform\Core\Service\CoreService
     */
    public static function coreService()
    {
        return self::$manager->getService('platform_core');
    }

    /**
     * @return \Platform\Group\Service\GroupService
     */
    public static function groupService()
    {
        return self::$manager->getService('base_group');
    }

    /**
     * @return \Platform\Video\Service\VideoService
     */
    public static function videoService()
    {
        return self::$manager->getService('base.video');
    }

    /**
     * @return \Platform\Photo\Service\PhotoService
     */
    public static function photoService()
    {
        return self::$manager->getService('base.photo');
    }

    /**
     * @return \Platform\Page\Service\PageService
     */
    public static function pageService()
    {
        return self::$manager->getService('base.page');
    }

    /**
     * @return \Platform\Event\Service\EventService
     */
    public static function eventService()
    {
        return self::$manager->getService('base.event');
    }

    /**
     * @return \Platform\User\Service\UserService
     */
    public static function userService()
    {
        return self::$manager->getService('platform_user');
    }

    /**
     * Shortcut to get site setting
     *
     * @param string $group
     * @param string $name
     * @param null   $defaultValue
     *
     * @return mixed
     */
    public static function setting($group, $name = null, $defaultValue = null)
    {
        return self::settingService()->get($group, $name, $defaultValue);
    }

    /**
     * @return \Platform\Captcha\Service\CaptchaService
     */
    public static function captchaService()
    {
        return \App::service('platform_captcha');
    }

    /**
     * Get site setting service
     *
     * @return \Platform\Setting\Service\SettingService
     */
    public static function settingService()
    {
        return self::$manager->getService('platform_setting');
    }

    /**
     * @return \Kendo\Request\Manager
     */
    public static function requestService()
    {
        return self::$manager->getService('request');
    }

    /**
     * Get content from database table has single primary key.
     *
     * @param string $alias
     * @param int    $id
     * @param bool   $reuse
     *
     * @return \Kendo\Content\ContentInterface
     */
    public static function find($alias, $id, $reuse = false)
    {
        if (empty($alias) or empty($id))
            return null;

        $key = $id . '@' . $alias;

        if ($reuse && !empty(self::$cachedItem[ $key ]))
            return self::$cachedItem[ $key ];


        $result = self::contentService()->getTable($alias)->findById($id);

        if ($reuse && $result)
            self::$cachedItem[ $key ] = $result;


        return $result;

    }

    /**
     * @return \Platform\Help\Service\HelpService
     */
    public static function helpService()
    {
        return self::$manager->getService('help');
    }

    /**
     * @return \Platform\Like\Service\LikeService
     */
    public static function likeService()
    {
        return self::$manager->getService('like');
    }

    /**
     * @return \Platform\Follow\Service\FollowService
     */
    public static function followService()
    {
        return self::$manager->getService('follow');
    }

    /**
     * @return \Platform\Phrase\Service\PhraseService
     */
    public static function phraseService()
    {
        return self::$manager->getService('platform_phrase');
    }

    /**
     * @return \Platform\Comment\Service\CommentService
     */
    public static function commentService()
    {
        return self::$manager->getService('comment');
    }

    /**
     * @return \Platform\Search\Service\SearchService
     */
    public function searchService()
    {
        return self::$manager->getService('search');
    }

    /**
     * @return \Platform\Share\Service\ShareService
     */
    public static function shareService()
    {
        return self::$manager->getService('share');
    }

    /**
     * @return \Kendo\Hook\Manager
     */
    public static function hookService()
    {
        return self::$manager->getService('hook');
    }

    /**
     * @return \Kendo\View\ViewFinder
     */
    public static function viewFinder()
    {
        return self::$manager->getService('viewFinder');
    }

    /**
     * @return \Kendo\Routing\Manager
     */
    public static function routingService()
    {
        return self::$manager->getService('routing');
    }

    /**
     * @return \Kendo\View\ViewHelper
     */
    public static function viewHelper()
    {
        return self::$manager->getService('viewHelper');
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
        return self::$manager->getService('i18n');
    }

    /**
     * @return \Kendo\Assets\Manager
     */
    public static function assetService()
    {
        return self::$manager->getService('assets');
    }

    /**
     * @return \Platform\Navigation\Service\NavigationService
     */
    public static function navigationService()
    {
        return self::$manager->getService('platform_navigation');
    }

    /**
     * @return \Kendo\Html\Manager
     */
    public static function htmlService()
    {
        return self::$manager->getService('html');
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
    public static function layoutService()
    {
        return self::$manager->getService('layout');
    }

    /**
     * @return \Kendo\Registry\Manager
     */
    public static function registryService()
    {
        return self::$manager->getService('registry');
    }

    /**
     * @return \Kendo\Image\Manager
     */
    public static function imageService()
    {
        return self::$manager->getService('image');
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
        return self::$manager->getService('core.value');
    }


    /**
     * @return \Kendo\Validator\Manager
     */
    public static function validationService()
    {
        return self::$manager->getService('validator');
    }

    /**
     * @return \Kendo\Auth\Manager
     */
    public static function authService()
    {
        return self::$manager->getService('auth');
    }

    /**
     * @return \Platform\Relation\Service\RelationService
     */
    public static function relationService()
    {
        return self::$manager->getService('relation');
    }

    /**
     * @return \Kendo\Sass\Manager
     */
    public static function styleService()
    {
        return self::$manager->getService('sass');
    }

    /**
     * @return \Platform\Social\Service\SocialService
     */
    public static function socialService()
    {
        return self::$manager->getService('base_social');
    }

    /**
     * @return \Platform\Core\Service\AggregateService
     */
    public static function aggregate()
    {
        return self::$manager->getService('core.aggregate');
    }

    /**
     * @return \Platform\Catalog\Service\CatalogService
     */
    public static function catalogService()
    {
        return self::$manager->getService('attribute');
    }


    /**
     * @return \Platform\Report\Service\ReportService
     */
    public static function reportService()
    {
        return self::$manager->getService('report');
    }

    /**
     * @return \Kendo\Db\QueryProfiler
     */
    public static function queryProfiler()
    {
        return self::$manager->getService('query_profiler');
    }
}


