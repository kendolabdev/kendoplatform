<?php
namespace Core\Service;

use Core\Model\Value;
use Kendo\Content\PosterInterface;

/**
 * Class ValueService
 *
 * @package Core\Service
 */
class ValueService
{
    /**
     * List of poster value object by distance.
     *
     * @var array
     */
    private $objects = [];

    /**
     * @param PosterInterface $parent
     *
     * @return array
     */
    private function findValues(PosterInterface $parent)
    {
        if (empty($this->objects[ $parent->getId() ])) {
            $values = [];

            $item = \App::table('core.value')
                ->select()
                ->where('parent_id=?', $parent->getId())
                ->one();

            if ($item && null != $item->__get('values_text')) {
                $values = json_decode($item->__get('values_text'), true);
            }
            $this->objects[ $parent->getId() ] = $values;
        }

        return $this->objects[ $parent->getId() ];
    }

    /**
     * @param PosterInterface $parent
     * @param array           $values
     */
    private function saveValues(PosterInterface $parent, $values)
    {
        if (empty($values)) {
            $values = [];
        }

        $this->objects[ $parent->getId() ] = $values;

        $item = \App::table('core.value')
            ->findById($parent->getId());

        if (!$item) {
            $item = new Value([
                'parent_id'   => $parent->getId(),
                'parent_type' => $parent->getType(),
            ]);
        }

        $item->__set('values_text', json_encode($values));
        $item->save();
    }

    /**
     * @param PosterInterface $parent
     * @param string          $name
     * @param mixed           $defaultValue
     *
     * @return mixed
     */
    public function getValue(PosterInterface $parent, $name, $defaultValue = null)
    {
        $values = $this->findValues($parent);

        return isset($values[ $name ]) ? $values[ $name ] : $defaultValue;
    }

    /**
     * @param PosterInterface $parent
     * @param string          $name
     * @param mixed           $value
     */
    public function setValue(PosterInterface $parent, $name, $value)
    {
        $values = $this->findValues($parent);

        $values[ $name ] = $value;

        $this->saveValues($parent, $values);
    }

    /**
     * @param PosterInterface $parent
     * @param        $newValues
     */
    public function mergeValues(PosterInterface $parent, $newValues)
    {
        $values = $this->findValues($parent);

        $values = array_merge($values, $newValues);

        $this->saveValues($parent, $values);

    }
}