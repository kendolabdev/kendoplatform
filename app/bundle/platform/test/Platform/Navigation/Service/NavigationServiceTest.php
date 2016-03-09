<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 3:54 PM
 */

namespace Platform\Navigation\Service;


class NavigationServiceTest extends \PHPUnit_Framework_TestCase
{

    public function testDecorator()
    {
        app()->navigation()->render('dropdown', 'main', null);

        app()->navigation()->render('dropdown', 'main', 'main_blog');

        app()->navigation()->render('tab', 'main', null);

        app()->navigation()->render('tab', 'main', 'main_blog');

    }
}
