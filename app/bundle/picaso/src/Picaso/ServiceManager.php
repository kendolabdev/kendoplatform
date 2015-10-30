<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Picaso
 */
namespace Picaso;

/**
 * Class ServiceManager
 *
 * @package Picaso
 */
class ServiceManager
{
    /**
     * @var array
     */
    private $services = [];

    /**
     * @var array
     */
    private $classes = [];

    /**
     * Prevent public construct
     */
    public function __construct()
    {
        $this->classes = [
            'cache'          => '\Picaso\Cache\Manager',
            'logger'         => '\Picaso\Log\Manager',
            'i18n'           => '\Picaso\I18n\Manager',
            'phrase'         => '\Phrase\Service\PhraseService',
            'content'        => '\Picaso\Content\Manager',
            'acl'            => '\Acl\Service\AclService',
            'help'           => '\Help\Service\HelpService',
            'setting'        => '\Setting\Service\SettingService',
            'request'        => '\Picaso\Request\Manager',
            'pusher'         => '\Picaso\PushNotification\Manager',
            'hook'           => '\Picaso\Hook\Manager',
            'viewFinder'     => '\Picaso\View\ViewFinder',
            'routing'        => '\Picaso\Routing\Manager',
            'app'            => '\Picaso\Application\Manager',
            'viewHelper'     => '\Picaso\View\ViewHelper',
            'assets'         => '\Picaso\Assets\Manager',
            'navigation'     => '\Navigation\Service\NavigationService',
            'html'           => '\Picaso\Html\Manager',
            'layout'         => '\Layout\Service\LayoutService',
            'registry'       => '\Picaso\Registry\Manager',
            'image'          => '\Picaso\Image\Manager',
            'storage'        => '\Storage\Service\StorageService',
            'auth'           => '\Picaso\Auth\Manager',
            'user'           => '\User\Service\UserService',
            'relation'       => '\Relation\Service\RelationService',
            'paging'         => '\Picaso\Paging\Manager',
            'validator'      => '\Picaso\Validator\Manager',
            'sass'           => '\Picaso\Sass\Manager',
            'session'        => '\Picaso\Session\Manager',
            'twig'           => '\Picaso\Twig\Manager',
            'comparator'     => '\Picaso\Comparator\Manager',
            'query_profiler' => '\Picaso\Db\QueryProfiler',
        ];

        $this->services = [
            'autoload' => Autoload\Manager::getInstance(),
            'registry' => new Registry\Manager(),
            'db'       => new Db\Manager(),
        ];
    }


    /**
     * @param string $name
     *
     * @return
     */
    public function getService($name)
    {
        if (!isset($this->services[ $name ])) {

            $class = $this->getServiceClassName($name);

            $service = new $class();

            $this->services[ $name ] = $service;
        }

        return $this->services[ $name ];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasService($name)
    {
        if (!isset($this->services[ $name ])) {
            $class = $this->getServiceClassName($name);
            if (!class_exists($class))
                return false;
        }

        return true;
    }

    /**
     * @param  string $name
     *
     * @return string
     * @throws Exception
     */
    public function getServiceClassName($name)
    {
        if (!empty($this->classes[ $name ]))
            return $this->classes[ $name ];


        if (false === strpos($name, '.')) {
            $temp = ucfirst($name);
            $class = "\\{$temp}\\Service\\{$temp}Service";
        } else {
            $class = '\\' . str_replace(' ', '', ucwords(str_replace(['.', '_'], ['\Service\ ', ' '], $name))) . 'Service';
        }

        return $class;
    }

    /**
     * Register a service
     *
     * @param string $name
     * @param string $className
     */
    public function registerService($name, $className)
    {
        $this->classes[ $name ] = $className;
    }
}