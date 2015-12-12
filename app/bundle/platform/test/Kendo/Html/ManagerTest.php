<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/10/15
 * Time: 1:36 PM
 */

namespace Kendo\Html;

use Kendo\Test\TestCase;

/**
 * Class ManagerTest
 *
 * @package Kendo\Html
 */
class ManagerTest extends TestCase
{
    /**
     *
     */
    public function testGeneral()
    {
        $manager = new Manager();

        $faker = $this->getFaker();

        foreach ($manager->getPlugins() as $pluginName => $pluginClass) {
            $element = $manager->create([
                'plugin'  => $pluginName,
                'label'   => $faker->sentence(),
                'note'    => $faker->paragraph(),
                'options' => []
            ]);

            $manager->factory($pluginClass, []);

            $element->toHtml();
        }
    }

    /**
     *
     */
    public function testHtmlForm()
    {
        $form = new Form();

        $manager = new Manager();

        $faker = $this->getFaker();

        $name = 'field_';
        $iteration = 0;

        foreach ($manager->getPlugins() as $pluginName => $pluginClass) {
            $form->addElement([
                'plugin'      => $pluginName,
                'name'        => $name . '_' . (++$iteration),
                'label'       => $faker->sentence,
                'note'        => $faker->paragraph,
                'placeholder' => $faker->sentence,
            ]);
        }

        // add more options

        $form->addElement([
            'name'          => 'custom_1',
            'plugin'        => 'textarea',
            'htmlEditor'    => true,
            'pluginOptions' => ['key' => 'value'],
            'value'         => 'some test contain',
        ]);

        $form->addElement([
            'name'       => 'custom_2',
            'plugin'     => 'multiselect',
            'required'   => true,
            'htmlEditor' => true,
            'value'      => 'some test contain',
            'options'    => [
                ['label' => $faker->sentence, 'value' => $iteration++],
                ['label' => $faker->sentence, 'value' => $iteration++],
                ['label' => $faker->sentence, 'value' => $iteration++],
            ]
        ]);

        $form->addElement([
            'name'       => 'custom_3',
            'plugin'     => 'multicheckbox',
            'required'   => true,
            'htmlEditor' => true,
            'value'      => 'some test contain',
            'options'    => [
                ['label' => $faker->sentence, 'value' => $iteration++],
                ['label' => $faker->sentence, 'value' => $iteration++],
                ['label' => $faker->sentence, 'value' => $iteration++],
            ]
        ]);


        foreach ($manager->getDecorators() as $renderName => $renderValue) {
            $form->renderElements($renderName);
        }

        $data = $form->getData();

        $form->setData($data);

        $form->isValid($data);

        $form->getByNames();

        $form->getElements();

        $form->getElement('name_1');

        $form->getElement('name__');

        $form->removeElement('name_1');

        $form->getValue();

        $form->setMethod('get');

        $this->assertEquals($form->getAttribute('method'), 'GET');

        $form->setAction('/');

        $this->assertEquals('/', $form->getAttribute('action'));

        $form->setEnctype('multipart/form-data');

        $this->assertEquals('multipart/form-data', $form->getAttribute('enctype'));
    }
}
