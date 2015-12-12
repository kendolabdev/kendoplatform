<?php
namespace Platform\Social\Service;

/**
 * Class SocialService
 *
 * @package Social\Service
 */
class SocialService
{
    /**
     * @var array
     */
    protected $adapters = [];

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getAdapter($name)
    {
        if (empty($this->adapters[ $name ])) {
            $this->adapters[ $name ] = $this->createAdapter($name);
        }

        return $this->adapters[ $name ];
    }

    /**
     * @param string $name
     */
    public function createAdapter($name)
    {
        $class = '\\Social\\Adapter\\' . ucfirst($name) . 'Adapter';

        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Service $name is not implement!");
        }

        return new $class();
    }

    /**
     * Get list of auth service
     *
     * @return array
     */
    public function getListAuth()
    {
        return \App::table('platform_social_service')
            ->select()
            ->where('id IN ?', ['facebook', 'twitter', 'google', 'window'])
            ->all();
    }
}