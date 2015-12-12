<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 2:37 PM
 */

namespace Kendo\Assets;


class LinkTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $link = new Link();

        $link->render();

        $link->add('bootstrap.css', 'style/bootstrap.css');
        $link->add('slider.css', ['href' => 'style/slider.css', 'type' => 'text/css', 'rel' => 'stylesheet']);

        $link->addAll([
            'more.css'  => 'style/more.css',
            'more2.css' => ['href' => 'style/more2.css'],
        ]);

        $link->prependAll([
            'first0' => 'style/first0.css',
            'fist1'  => ['href' => 'style/first1.css', 'type' => 'text/css', 'rel' => 'stylesheet']
        ]);


        $this->assertNotEmpty($link->get('more.css'));

        $link->remove('more.css');

        $this->assertEmpty($link->get('more.css'));

        $link->prepend('first_of_first', 'style/bootstrap.css');

        $link->prepend('first_of_first', ['href' => 'style/bootstrap.css', 'rel' => 'stylesheet']);

        $link->render();
    }
}
