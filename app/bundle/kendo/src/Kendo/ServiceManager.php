<?php

/**
 * @author  Nam Nguyen <namnv@younetco.com>
 * @version 1.0.1
 * @package Kendo
 */
namespace Kendo;

/**
 * Class ServiceManager
 *
 * @package Kendo
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
            'cache'          => '\Kendo\Cache\Manager',
            'logger'         => '\Kendo\Log\Manager',
            'i18n'           => '\Kendo\I18n\Manager',
            'phrase'         => '\Phrase\Service\PhraseService',
            'content'        => '\Kendo\Content\Manager',
            'acl'            => '\Platform\Acl\Service\AclService',
            'help'           => '\Base\Help\Service\HelpService',
            'setting'        => '\Platform\Setting\Service\SettingService',
            'request'        => '\Kendo\Request\Manager',
            'pusher'         => '\Kendo\PushNotification\Manager',
            'hook'           => '\Kendo\Hook\Manager',
            'viewFinder'     => '\Kendo\View\ViewFinder',
            'routing'        => '\Kendo\Routing\Manager',
            'app'            => '\Kendo\Application\Manager',
            'viewHelper'     => '\Kendo\View\ViewHelper',
            'assets'         => '\Kendo\Assets\Manager',
            'navigation'     => '\Navigation\Service\NavigationService',
            'html'           => '\Kendo\Html\Manager',
            'layout'         => '\Platform\Layout\Service\LayoutService',
            'registry'       => '\Kendo\Registry\Manager',
            'image'          => '\Kendo\Image\Manager',
            'storage'        => '\Platform\Storage\Service\StorageService',
            'auth'           => '\Kendo\Auth\Manager',
            'user'           => '\Platform\User\Service\UserService',
            'relation'       => '\Platform\Relation\Service\RelationService',
            'paging'         => '\Kendo\Paging\Manager',
            'validator'      => '\Kendo\Validator\Manager',
            'sass'           => '\Kendo\Sass\Manager',
            'session'        => '\Kendo\Session\Manager',
            'twig'           => '\Kendo\Twig\Manager',
            'comparator'     => '\Kendo\Comparator\Manager',
            'query_profiler' => '\Kendo\Db\QueryProfiler',
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

            if (!class_exists($class)) {
                throw new \InvalidArgumentException("Missing class " . $class);
            }

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
     * @param  string $serviceName
     *
     * @return string
     * @throws Exception
     */
    public function getServiceClassName($serviceName)
    {
        if (!empty($this->classes[ $serviceName ]))
            return $this->classes[ $serviceName ];

        $arr = explode('_', $serviceName, 3);

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
    public function registerService($name, $className)
    {
        $this->classes[ $name ] = $className;
    }
}