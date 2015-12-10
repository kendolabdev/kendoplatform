<?php
namespace Platform\Core\Service;

use Platform\Core\Model\Aggregate;

/**
 * Class AggregateService
 *
 * @package Core\Service
 */
class AggregateService
{
    /**
     * @param string $id
     *
     * @return array
     */
    public function all($id)
    {
        return \App::table('core.aggregate')
            ->select()
            ->where('id=?', $id)
            ->toPairs('name', 'value');
    }

    /**
     * @param string $id
     * @param string $name
     *
     * @return int
     */
    public function one($id, $name)
    {
        return \App::table('core.aggregate')
            ->select()
            ->where('id=?', $id)
            ->where('name=?', $name)
            ->field('value');
    }

    /**
     * @param $id
     * @param $name
     * @param $value
     */
    public function change($id, $name, $value)
    {
        $item = \App::table('core.aggregate')
            ->select()
            ->where('id=?', $id)
            ->where('name=?', $name)
            ->one();

        if (!$item) {
            $item = new Aggregate([
                'id'    => $id,
                'name'  => $name,
                'value' => 0,
            ]);
            $item->save();
        }

        $item->modify('value', 'value+(' . $value . ')');
    }
}