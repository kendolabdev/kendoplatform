<?php

namespace Attribute\Form;

use Picaso\Html\Form;


class AttributeCustomForm extends Form
{
    /**
     * @var int
     */
    protected $catalogId = 0;

    /**
     * @var \Picaso\Content\HasAttribute
     */
    protected $forItem;

    /**
     * @return int
     */
    public function getCatalogId()
    {
        return $this->catalogId;
    }

    /**
     * @param int $catalogId
     */
    public function setCatalogId($catalogId)
    {
        if (null == $catalogId)
            $catalogId = 3;

        $this->catalogId = $catalogId;
    }

    /**
     * @return \Picaso\Content\HasAttribute
     */
    public function getForItem()
    {
        return $this->forItem;
    }

    /**
     * @param \Picaso\Content\HasAttribute $forItem
     */
    public function setForItem($forItem)
    {
        $this->forItem = $forItem;
        $this->setCatalogId($forItem->getCatalogId());
    }

    /**
     *
     */
    protected function init()
    {
        $this->addElement([
            'plugin' => 'hidden',
            'name'   => 'catalog_id',
            'value'  => $this->getCatalogId(),
        ]);

        $elements = \App::catalogService()
            ->loadCatalogElements($this->getCatalogId());

        if (!empty($elements))
            $this->addElements($elements);
    }
}