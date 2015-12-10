<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 2:49 PM
 */

namespace Kendo\Assets;


class ManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $manager = new Manager();

        $manager->getDescription();
        $manager->getUrl('/test');
        $manager->title()
            ->add('temporary');

        $manager->setTitle(new Title());

        $manager->requirejs()
            ->renderConfig();

        $manager->requirejs()
            ->renderConfigHtml();

        $manager->requirejs()
            ->renderScript();

        $manager->requirejs()
            ->renderScriptHtml();


    }
}
