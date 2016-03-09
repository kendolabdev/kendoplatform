<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 4:53 PM
 */

namespace Kendo\Session;


/**
 * Class ManagerTest
 *
 * @package Kendo\Session
 */
class ManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Provide session handler
     *
     * @return array
     */
    public function sessionProvider()
    {
        return [
            ['\Kendo\Session\NoneSaveHandler'],
            ['\Platform\Core\Session\FileSaveHandler'],
        ];
    }

    /**
     * Test session handler
     *
     * @dataProvider sessionProvider
     *
     * @param string $sessionName
     */
    public function testSessionHandler($sessionName)
    {
        app()->registryService()->set('SessionHandler', $sessionName);

        $id = 'unitest2';

        $manager = new Manager();
        $manager->open(null, $id);
        $manager->read($id);
        $manager->close();
        $manager->write($id, '');
        $manager->destroy($id);
        $manager->gc(100);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidSaveHandler()
    {

        app()->registryService()->set('SessionHandler', 'NoClass');
        ($manager = new Manager());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidSaveHandler2()
    {

        app()->registryService()->set('SessionHandler', 'StdClass');
        ($manager = new Manager());
    }
}
