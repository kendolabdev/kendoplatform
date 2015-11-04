<?php
namespace Picaso\Layout;

class BlockParams
{

    /**
     * @var array
     */
    private $params = [];

    /**
     * @param array|string $params
     */
    public function __construct($params)
    {
        if (is_string($params))
            $params = json_decode(base64_decode($params), true);
        $this->params = $params;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function forAvatar($type)
    {
        return 'card-wrap card-avatar ' . $this->req('grid_md grid_sm grid_xs card_space card_border', 'col-md-12 col-sm-12 col-xs-12 card-space-md card-border-bottom') . ' ' . $type;
    }

    /**
     * @param $list1
     * @param $list2
     *
     * @return string
     */
    public function req($list1, $list2)
    {
        $a1 = explode(' ', $list1);
        $a2 = explode(' ', $list2);
        $reach = count($a1);

        $return = [];

        for ($i = 0; $i < $reach; ++$i) {
            $return [] = $this->get($a1[ $i ], isset($a2[ $i ]) ? $a2[ $i ] : '');
        }

        return implode(' ', $return);
    }

    /**
     * @param string $name
     * @param null   $defaultValue
     *
     * @return mixed
     */
    public function get($name, $defaultValue = null)
    {
        return isset($this->params[ $name ]) ? $this->params[ $name ] : $defaultValue;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function forMedia($type)
    {
        return 'card-wrap card-media ' . $this->req('grid_md grid_sm grid_xs card_space card_border media_position media_ratio', 'col-md-4 col-sm-6 col-xs-12 card-space-md card-border-bottom media-top media-ratio-85') . ' ' . $type;
    }

    public function all()
    {
        return $this->params;
    }

    /**
     * @param string $default
     *
     * @return string
     */
    public function script($default = 'render1')
    {
        $name = !empty($this->params['base_script']) ? $this->params['base_script'] : $default;

        return $this->params['base_path'] . '/' . $name;
    }

    /**
     * @param string $default
     *
     * @return string
     */
    public function itemScript($default = 'render1')
    {
        $name = !empty($this->params['item_script']) ? $this->params['item_script'] : $default;

        return $this->params['item_path'] . '/' . $name;
    }

    /**
     * @return string
     */
    public function endless()
    {
        return !empty($this->params['endless']) && $this->params['endless'] ? 'true' : 'false';
    }

    /**
     *
     */
    public function __toString()
    {
        return base64_encode(json_encode($this->params));
    }

    /**
     * @param $key
     * @param $val
     */
    public function set($key, $val)
    {
        $this->params[ $key ] = $val;
    }
}