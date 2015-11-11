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
     * @var \Picaso\ServiceManager
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

        if (!$staticUrl OR defined('PICASO_DEVELOPMENT') && PICASO_DEVELOPMENT) {
            $staticUrl = PICASO_BASE_URL;
        }

        return $staticUrl;

    }

    /**
     * @return \Picaso\Application\Manager
     */
    public static function extensions()
    {
        return self::$manager->getService('app');
    }

    /**
     * @return \Invitation\Service\InvitationService
     */
    public static function invitation()
    {
        return self::$manager->getService('invitation');
    }

    /**
     * @return \Notification\Service\NotificationService
     */
    public static function notification()
    {
        return self::$manager->getService('notification');
    }

    /**
     * @return \Relation\Service\RelationService
     */
    public static function membership()
    {
        return \App::relation();
    }

    /**
     * @return \Message\Service\MessageService
     */
    public static function message()
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
     * @return \Feed\Service\FeedService
     */
    public static function feed()
    {
        return self::$manager->getService('feed');
    }

    /**
     * @return \Tag\Service\TagService
     */
    public static function tag()
    {
        return self::$manager->getService('tag');
    }

    /**
     * @return \Picaso\Twig\Manager
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
            \Picaso\Autoload\Manager::getInstance();

            // init service manager
            self::$manager = new \Picaso\ServiceManager();

            self::$manager->getService('app')->bootstrap();
        }
    }

    /**
     * @return \Mail\Service\MailService
     */
    public static function mail()
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
     * @return \Acl\Service\AclService
     */
    public static function acl()
    {
        return self::$manager->getService('acl');
    }

    /**
     * @return \Picaso\Db\Manager
     */
    public static function db()
    {
        return self::$manager->getService('db');
    }

    /**
     * @return \Picaso\Session\Manager
     */
    public static function session()
    {
        return self::$manager->getService('session');
    }

    /**
     * @return \Picaso\Paging\Manager
     */
    public static function paging()
    {
        return self::$manager->getService('paging');
    }

    /**
     * @return \Picaso\Autoload\Manager
     */
    public static function autoload()
    {
        return self::$manager->getService('autoload');
    }

    /**
     * @return \Picaso\Cache\Manager
     */
    public static function cache()
    {
        return self::$manager->getService('cache');

    }

    /**
     * @return \Picaso\Log\Manager
     */
    public static function logger()
    {
        return self::$manager->getService('log');
    }

    /**
     * @return \Storage\Service\StorageService
     */
    public static function storage()
    {
        return self::$manager->getService('storage');
    }

    /**
     * @usages \App::table('user') <br />
     * If you want to use full class name, use \App::db()->table('\User\Model\User')
     *
     * @param string $alias
     *
     * @return \Picaso\Db\DbTable
     */
    public static function table($alias)
    {
        return self::content()->getTable($alias);
    }

    /**
     * @return \Picaso\Content\Manager
     */
    public static function content()
    {
        return self::$manager->getService('content');
    }

    /**
     * @return \Link\Service\LinkService
     */
    public static function link()
    {
        return self::$manager->getService('link');
    }

    /**
     * @return \Blog\Service\BlogService
     */
    public static function blog()
    {
        return self::$manager->getService('blog');
    }

    /**
     * @return \Core\Service\CoreService
     */
    public static function core()
    {
        return self::$manager->getService('core');
    }

    /**
     * @return \Group\Service\GroupService
     */
    public static function group()
    {
        return self::$manager->getService('group');
    }

    /**
     * @return \Video\Service\VideoService
     */
    public static function video()
    {
        return self::$manager->getService('video');
    }

    /**
     * @return \Photo\Service\PhotoService
     */
    public static function photo()
    {
        return self::$manager->getService('photo');
    }

    /**
     * @return \Page\Service\PageService
     */
    public static function page()
    {
        return self::$manager->getService('page');
    }

    /**
     * @return \Event\Service\EventService
     */
    public static function event()
    {
        return self::$manager->getService('event');
    }

    /**
     * @return \User\Service\UserService
     */
    public static function user()
    {
        return self::$manager->getService('user');
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
        return self::settings()->get($group, $name, $defaultValue);
    }

    /**
     * @return \Captcha\Service\CaptchaService
     */
    public static function captcha()
    {
        return \App::service('captcha');
    }

    /**
     * Get site setting service
     *
     * @return \Setting\Service\SettingService
     */
    public static function settings()
    {
        return self::$manager->getService('setting');
    }

    /**
     * @return \Picaso\Request\Manager
     */
    public static function request()
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
     * @return \Picaso\Content\Content
     */
    public static function find($alias, $id, $reuse = false)
    {
        if (empty($alias) or empty($id))
            return null;

        $key = $id . '@' . $alias;

        if ($reuse && !empty(self::$cachedItem[ $key ]))
            return self::$cachedItem[ $key ];


        $result = self::content()->getTable($alias)->findById($id);

        if ($reuse && $result)
            self::$cachedItem[ $key ] = $result;


        return $result;

    }

    /**
     * @return \Help\Service\HelpService
     */
    public static function help()
    {
        return self::$manager->getService('help');
    }

    /**
     * @return \Like\Service\LikeService
     */
    public static function like()
    {
        return self::$manager->getService('like');
    }

    /**
     * @return \Follow\Service\FollowService
     */
    public static function follow()
    {
        return self::$manager->getService('follow');
    }

    /**
     * @return \Phrase\Service\PhraseService
     */
    public static function phrase()
    {
        return self::$manager->getService('phrase');
    }

    /**
     * @return \Comment\Service\CommentService
     */
    public static function comment()
    {
        return self::$manager->getService('comment');
    }

    /**
     * @return \Search\Service\SearchService
     */
    public function search()
    {
        return self::$manager->getService('search');
    }

    /**
     * @return \Share\Service\ShareService
     */
    public static function share()
    {
        return self::$manager->getService('share');
    }

    /**
     * @return \Picaso\Hook\Manager
     */
    public static function hook()
    {
        return self::$manager->getService('hook');
    }

    /**
     * @return \Picaso\View\ViewFinder
     */
    public static function viewFinder()
    {
        return self::$manager->getService('viewFinder');
    }

    /**
     * @return \Picaso\Routing\Manager
     */
    public static function routing()
    {
        return self::$manager->getService('routing');
    }

    /**
     * @return \Picaso\View\ViewHelper
     */
    public static function viewHelper()
    {
        return self::$manager->getService('viewHelper');
    }

    /**
     * @return \Picaso\I18n\Translator
     */
    public static function trans()
    {
        return self::i18n()->getTranslator();
    }

    /**
     * @return \Picaso\I18n\Manager
     */
    public static function i18n()
    {
        return self::$manager->getService('i18n');
    }

    /**
     * @return \Picaso\Assets\Manager
     */
    public static function assets()
    {
        return self::$manager->getService('assets');
    }

    /**
     * @return \Navigation\Service\NavigationService
     */
    public static function nav()
    {
        return self::$manager->getService('navigation');
    }

    /**
     * @return \Picaso\Html\Manager
     */
    public static function html()
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
        if (defined('PICASO_INSTALLATION'))
            return $msgId;

        return self::i18n()->getTranslator()->text($msgId, $data, $count);
    }

    /**
     * @return \Layout\Service\LayoutService
     */
    public static function layout()
    {
        return self::$manager->getService('layout');
    }

    /**
     * @return \Picaso\Registry\Manager
     */
    public static function registry()
    {
        return self::$manager->getService('registry');
    }

    /**
     * @return \Picaso\Image\Manager
     */
    public static function image()
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
     * @return \Core\Service\ValueService
     */
    public static function values()
    {
        return self::$manager->getService('core.value');
    }


    /**
     * @return \Picaso\Validator\Manager
     */
    public static function validator()
    {
        return self::$manager->getService('validator');
    }

    /**
     * @return \Picaso\Auth\Manager
     */
    public static function auth()
    {
        return self::$manager->getService('auth');
    }

    /**
     * @return \Relation\Service\RelationService
     */
    public static function relation()
    {
        return self::$manager->getService('relation');
    }

    /**
     * @return \Picaso\Sass\Manager
     */
    public static function sass()
    {
        return self::$manager->getService('sass');
    }

    /**
     * @return \Picaso\Comparator\Manager
     */
    public static function comparator()
    {
        return self::$manager->getService('comparator');
    }

    /**
     * @return Social\Service\SocialService
     */
    public static function social()
    {
        return self::$manager->getService('social');
    }

    /**
     * @return \Core\Service\AggregateService
     */
    public static function aggregate()
    {
        return self::$manager->getService('core.aggregate');
    }

    /**
     * @return \Attribute\Service\AttributeService
     */
    public static function attribute()
    {
        return self::$manager->getService('attribute');
    }


    /**
     * @return \Report\Service\ReportService
     */
    public static function report()
    {
        return self::$manager->getService('report');
    }

    /**
     * @return \Picaso\Db\QueryProfiler
     */
    public static function queryProfiler()
    {
        return self::$manager->getService('query_profiler');
    }

}


