<?php

namespace Platform\Catalog\Form;

use Kendo\Html\Form;


class AttributeCustomForm extends Form
{
    /**
     * @var int
     */
    protected $catalogId = 0;

    /**
     * @var \Kendo\Content\CatalogInterface
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
     * @return \Kendo\Content\CatalogInterface
     */
    public function getForItem()
    {
        return $this->forItem;
    }

    /**
     * @param \Kendo\Content\CatalogInterface $forItem
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

        $elements = app()->catalogService()
            ->loadCatalogElements($this->getCatalogId());

        if (!empty($elements))
            $this->addElements($elements);
    }
}