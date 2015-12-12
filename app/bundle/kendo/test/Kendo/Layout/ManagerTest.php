<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/11/15
 * Time: 10:41 AM
 */

namespace Kendo\Layout;


class ManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function decoratorProvider()
    {
        return [
            ['\Kendo\Layout\CalloutDecorator', '', []],
            ['\Kendo\Layout\DefaultDecorator', '', []],
            ['\Kendo\Layout\PanelDecorator', '', []],
            ['\Kendo\Layout\AlertDecorator', '', []],
            ['\Kendo\Layout\NoneDecorator', '', []],
            ['\Kendo\Layout\UnitDecorator', '', []],
            ['\Kendo\Layout\WidgetDecorator', '', []],
        ];
    }

    /**
     * @dataProvider decoratorProvider
     *
     * @param $decoratorClass
     * @param $decoratorType
     * @param $decoratorConfig
     */
    public function testDecorator($decoratorClass, $decoratorType, $decoratorConfig)
    {
        $decoratorParams = new DecoratorParams($decoratorType, $decoratorConfig);
        $block = new Block();

        $block->setTitle('sample_title');
        $block->setBadge('4');
        $block->setIcon('no_icon');
        $block->getView()->setScript('');

        $decorator = new $decoratorClass();

        $decorator->render($block, $decoratorParams);

    }

    public function testBlock()
    {
        $block = new Block();

        $block->setIcon('sample_icon');
        $this->assertEquals('sample_icon', $block->getIcon());

        $block->setTitle('sample_title');

        $this->assertEquals('sample_title', $block->getTitle());

        $block->setBadge('4');
        $this->assertEquals('4', $block->getBadge());

        $this->assertEquals('kendo-layout', $block->getCssClassName());

        $block->setNoRender(false);
        $this->assertFalse($block->isNoRender());


        $block->setNoRender(true);
        $this->assertTrue($block->isNoRender());
    }

    public function testDecoratorParams()
    {
        $params = new DecoratorParams('sample_type', ['key1' => 'val1']);

        $this->assertEquals('sample_type', $params->getPlugin());

        $params->setPlugin('sample_type2');
        $this->assertEquals('sample_type2', $params->getPlugin());

        $this->assertEquals($params->key1, 'val1');
        $params->key2 = 'val2';
        $this->assertEquals('val2', $params->key2);

        $params->set('key3', 'val3');
        $this->assertEquals('val3', $params->__get('key3'));
    }

    /**
     *
     */
    public function testBlockParams()
    {
        $params = new BlockParams([
            'base_path' => 'sample_base_path',
            'item_path' => 'sample_item_path',
        ]);

        $this->assertEquals('sample_base_path/view', $params->script());
        $this->assertEquals('sample_item_path/view', $params->itemScript());
        $params->endless();
        $params->forAvatar('sm');
        $params->forMedia('large');
        $params->all();

    }
}
