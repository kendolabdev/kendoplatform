<?php

namespace Attribute\Form;

use Picaso\Html\Form;

/**
 * Class PluginBaseSetting
 *
 * @package Attribute\Form
 */
class PluginBaseSetting extends Form
{
    /**
     * @var \Attribute\Model\AttributeField
     */
    protected $field;

    /**
     * @return \Attribute\Model\AttributeField
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param \Attribute\Model\AttributeField $field
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
