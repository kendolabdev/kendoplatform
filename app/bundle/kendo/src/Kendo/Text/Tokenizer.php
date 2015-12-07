<?php

namespace Kendo\Text;

/**
 * Class Tokenizer
 *
 * @package Kendo\Text
 */
class Tokenizer
{

    /**
     * @var array
     */
    private $maps = [];

    /**
     * @return array
     */
    public function getMaps()
    {
        return $this->maps;
    }

    /**
     * @param array $maps
     */
    public function setMaps($maps)
    {
        $this->maps = $maps;
    }

    /**
     * @param string $string
     * @param null   $object
     *
     * @return string
     */
    public function parse($string, $object = null)
    {
        $replacements = $this->getReplacements($string);

        if (empty($replacements)) {
            return $string;
        }

        foreach ($replacements as $key => $opt) {
            $replacements[ $key ] = call_user_func([$this, $opt[0]], $object, $opt[1], $opt[2]);
        }

        return strtr($string, $replacements);
    }

    /**
     * @param  $string
     *
     * @return array
     */
    public function getReplacements($string)
    {
        if (empty($this->maps[ $string ])) {
            $tokens = [];

            if (preg_match_all("#({\\$[^}]+})#i", $string, $all, PREG_PATTERN_ORDER) > 0) {
                foreach ($all[1] as $token) {
                    preg_match_all("#([\w]+)#", $token, $params);
                    $params = $params[1];

                    $callbackMethod = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', array_shift($params))));


                    $tokens[ $token ] = [$callbackMethod, array_shift($params), array_shift($params)];
                }
            }
            $this->maps[ $string ] = $tokens;
        }

        return $this->maps[ $string ];
    }

    /**
     * Failover method
     *
     * @param $name
     * @param $arguments
     *
     * @return string
     */
    function __call($name, $arguments)
    {
        return "";
    }


}