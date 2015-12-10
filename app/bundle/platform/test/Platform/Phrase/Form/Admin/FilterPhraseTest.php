<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/9/15
 * Time: 1:04 AM
 */

namespace Platform\Phrase\Form\Admin;


class FilterPhraseTest extends \PHPUnit_Framework_TestCase
{

    public function testGeneral()
    {
        $form = new FilterPhrase();

        $this->assertNotEmpty($form);
    }
}
