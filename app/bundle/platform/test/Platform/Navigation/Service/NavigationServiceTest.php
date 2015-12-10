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
        \App::navigationService()->render('dropdown', 'main', null);

        \App::navigationService()->render('dropdown', 'main', 'main_blog');

        \App::navigationService()->render('tab', 'main', null);

        \App::navigationService()->render('tab', 'main', 'main_blog');

    }
}
