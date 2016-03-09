<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 4:09 PM
 */

namespace Kendo\Navigation;


class DecoratorTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @return array
     */
    public function navigationProvider()
    {
        return [
            ['main', null, [], 4, []],
            ['main', 'main_blog', [], 4, []],
            ['admin', null, [], 4, []],
            ['main', null, [], 1, []],
            ['main', 'main_blog', [], 1, []],
            ['admin', null, [], 1, []],
        ];
    }

    /**
     * @dataProvider  navigationProvider
     *
     * @param string $navId
     * @param string $parentItemId
     * @param array  $active
     * @param int    $level
     * @param array  $param
     */
    public function testMainNav($navId, $parentItemId, $active, $level, $param)
    {
        $items = app()->navigation()->load($navId, $parentItemId);

        $tab = new TabDecorator();

        $tab->setup($navId, $parentItemId, $items, $active, $level, $param);

        $tab->render();

        $dropdown = new DropdownDecorator();

        $dropdown->setup($navId, $parentItemId, $items, $active, $level, $param);

        $dropdown->render();
    }

}
