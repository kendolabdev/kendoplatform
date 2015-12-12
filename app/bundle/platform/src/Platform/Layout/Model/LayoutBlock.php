<?php
/**
 * Generate by CodeGenerator\DbTable for table `kendo_layout_block`
 */

namespace Platform\Layout\Model;

/**
 */
use Kendo\Model;

/**
 * Class Platform\LayoutBlock
 *
 * @package Platform\Layout\Model
 */
class LayoutBlock extends Model
{

    /**
     * @return array
     */
    public function getBlockParams()
    {
        return (array)json_decode($this->getBlockParamsText(), true);
    }

    /**
     * @param string|array $data
     */
    public function setBlockParams($data)
    {
        if (!is_string($data))
            $data = json_encode($data);

        $this->setBlockParamsText($data);
    }

    /**
     * @param array $data
     */
    public function addBlockParams($data)
    {
        $old = $this->getBlockParams();
        $new = array_merge($old, $data);
        $this->setBlockParams($new);

    }
    //START_TABLE_GENERATOR


    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->__get('block_id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('block_id', $value);
    }

    /**
     * @return null|string
     */
    public function getBlockId()
    {
        return $this->__get('block_id');
    }

    /**
     * @param $value
     */
    public function setBlockId($value)
    {
        $this->__set('block_id', $value);
    }

    /**
     * @return null|string
     */
    public function getParentBlockId()
    {
        return $this->__get('parent_block_id');
    }

    /**
     * @param $value
     */
    public function setParentBlockId($value)
    {
        $this->__set('parent_block_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSectionId()
    {
        return $this->__get('section_id');
    }

    /**
     * @param $value
     */
    public function setSectionId($value)
    {
        $this->__set('section_id', $value);
    }

    /**
     * @return null|string
     */
    public function getNodeId()
    {
        return $this->__get('node_id');
    }

    /**
     * @param $value
     */
    public function setNodeId($value)
    {
        $this->__set('node_id', $value);
    }

    /**
     * @return null|string
     */
    public function getLeafId()
    {
        return $this->__get('leaf_id');
    }

    /**
     * @param $value
     */
    public function setLeafId($value)
    {
        $this->__set('leaf_id', $value);
    }

    /**
     * @return null|string
     */
    public function getSupportBlockId()
    {
        return $this->__get('support_block_id');
    }

    /**
     * @param $value
     */
    public function setSupportBlockId($value)
    {
        $this->__set('support_block_id', $value);
    }

    /**
     * @return null|string
     */
    public function getBlockOrder()
    {
        return $this->__get('block_order');
    }

    /**
     * @param $value
     */
    public function setBlockOrder($value)
    {
        $this->__set('block_order', $value);
    }

    /**
     * @return null|string
     */
    public function getBlockParamsText()
    {
        return $this->__get('block_params_text');
    }

    /**
     * @param $value
     */
    public function setBlockParamsText($value)
    {
        $this->__set('block_params_text', $value);
    }

    /**
     * @return \Platform\Layout\Model\LayoutBlockTable
     */
    public function table()
    {
        return \App::table('platform_layout_block');
    }
    //END_TABLE_GENERATOR
}