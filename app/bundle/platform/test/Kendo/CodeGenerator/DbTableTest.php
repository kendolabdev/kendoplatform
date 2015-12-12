<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 3:24 PM
 */

namespace Kendo\CodeGenerator;


class DbTableTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $generator = new DbTable();

        $generator->isTestOnly();

        $generator->setTestOnly(true);

        $generator->generate('picaso_platform_user');

        $generator->generate('picaso_platform_core_extension');
    }
}
