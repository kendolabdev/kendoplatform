<?php

namespace Platform\Catalog\Form;

use Kendo\Html\Form;

/**
 * Class PluginBaseSetting
 *
 * @package Attribute\Form
 */
class PluginBaseSetting extends Form
{
    /**
     * @var \Platform\Catalog\Model\AttributeField
     */
    protected $field;

    /**
     * @return \Platform\Catalog\Model\AttributeField
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param \Platform\Catalog\Model\AttributeField $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     *
     */
    public function load()
    {
        $data = $this->getField()->getParams();

        $this->setData($data);
    }

    /**
     * save data
     */
    public function save()
    {
        $data = $this->getData();
        $this->getField()->setParams($data);
        $this->getField()->save();
    }
}
