<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 3:45 PM
 */

namespace Kendo\Hook;


use Kendo\Assets\Requirejs;

class ManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $hook = new Manager();

        $this->assertFalse($hook->isLoaded());

        $hook->loadAllHookEvents();

        $hook->start();

        $this->assertEquals($hook->loadAllHookEvents(), $hook->loadAllHookEventFromRepository());

        $this->assertTrue($hook->isLoaded());

        $js = new Requirejs();

        $hook->notify('onBeforeBuildBundleJS', $js);

    }

    public function testSimpleContainer()
    {
        $vars = ['confirm' => 1];

        $container = new SimpleContainer($vars);

        $this->assertEquals($vars, $container->all());

        $container->add('confirm', 2);

        $this->assertEquals($container->all(), ['confirm' => 2]);

        $container->reset();

        $this->assertEquals($container->all(), []);

        $this->assertEmpty($container->get('test'));
    }

    /**
     *
     */
    public function testHookEvent()
    {
        $event = new HookEvent(null);

        $this->assertNull($event->getPayload());

        $this->assertEmpty($event->__toString());

        $this->assertEmpty($event->getResponse());

        $payload = ['key1' => 'val1', 'key2' => 'val2'];

        $event->setPayload($payload);

        $this->assertEquals($payload, $event->getPayload());

        $this->assertEquals($event->getPayload('key1'), $payload['key1']);
        $this->assertEquals($event->getPayload('key2'), $payload['key2']);
        $this->assertNull($event->getPayload('key3'));

        $event->prepend('test1');
        $event->append('test3');

        $this->assertEquals(['test1', 'test3'], $event->getResponse());

        $event->prepend('test0');

        $this->assertEquals(['test0', 'test1', 'test3'], $event->getResponse());

        $this->assertEquals($event->__toString(), implode('', ['test0', 'test1', 'test3']));

        $event->setResponse('');

        $this->assertEquals([''], $event->getResponse());
    }
}
