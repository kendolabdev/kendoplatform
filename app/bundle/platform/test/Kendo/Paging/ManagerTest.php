<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 11:06 PM
 */

namespace Kendo\Paging;


class ManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function pagingDataProvider()
    {

        return [
            [range(1, 100)],
            [\App::table('platform_user')->select()],
        ];

    }

    /**
     * @dataProvider pagingDataProvider
     *
     * @param mixed $data
     */
    public function testDecorator($data)
    {
        $manager = new Manager();

        $paging = $manager
            ->factory($data)
            ->paging(1, 10);

        $paging->setRouting('home', []);

        foreach ($manager->getDecorators() as $name => $value) {
            $manager->getDecorator($name, [], $paging)->render();
        }
    }


    public function testGeneral()
    {
        $manager = new Manager();

        $data = range(1, 100);

        $paging = $manager
            ->factory($data)
            ->paging(1, 10);


        $paging->setRouting('home', []);

        $paging->getNextUrl();
        $paging->getPrevUrl();
        $paging->getPager();

        $this->assertNotEmpty($paging->getUrl(2));
        $this->assertEquals(range(1, 10), $paging->items());

        $this->assertEquals(10, $paging->getLimit());
        $this->assertEquals($paging->count(), 100);
        $this->assertEquals($paging->itemCount(), 10);
        $this->assertEquals($paging->pageCount(), 10);
        $this->assertTrue($paging->hasNext());
        $this->assertFalse($paging->hasPrev());

        foreach ($manager->getDecorators() as $name => $value) {
            $manager->getDecorator($name, [], $paging)->render();
        }

        $paging->noLimit();

        foreach ($manager->getDecorators() as $name => $value) {
            $manager->getDecorator($name, [], $paging)->render();
        }

    }
}
