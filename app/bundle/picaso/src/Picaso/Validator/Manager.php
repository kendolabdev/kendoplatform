<?php
namespace Picaso\Validator;

/**
 * Class Manager
 *
 * @package Picaso\Validator
 */
class Manager
{

    /**
     * @var array
     */
    private $plugins = [
        'fileSize' => '\Picaso\Validator\RuleFileSize',
        'fileType' => '\Picaso\Validator\RuleFileType',
        'required' => '\Picaso\Validator\RuleRequired',
        'string'   => '\Picaso\Validator\RuleString',
        'compare'  => '\Picaso\Validator\RuleCompare',
        'unique'   => '\Picaso\Validator\RuleUnique',
        'regexp'   => '\Picaso\Validator\RuleRegexp',
    ];


    /**
     * @return array
     */
    public function getSupported()
    {
        return array_keys($this->plugins);
    }

    /**
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }


    /**
     * @param array $plugins
     */
    public function setPlugins($plugins)
    {
        $this->plugins = $plugins;
    }

    /**
     * @param string $name
     * @param string $classMap
     *
     * @return Manager
     */
    public function addPlugin($name, $classMap)
    {
        $this->plugins[ $name ] = $classMap;
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return ValidateInterface
     */
    public function factory($name, $params = [])
    {

        if (is_string($name)) {
            return $this->build($name, $params);
        } else if (is_array($name)) {
            return new RuleSet($name);
        }
    }

    /**
     * @param $name
     * @param $params
     *
     * @return ValidateInterface
     */
    public function build($name, $params)
    {
        if (empty($this->plugins[ $name ])) {
            throw new \InvalidArgumentException("validator [$name] does not supported.");
        }

        $class = $this->plugins[ $name ];

        return new $class($params);
    }
}