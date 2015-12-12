<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/11/15
 * Time: 10:19 PM
 */

namespace Platform\User\Controller;
use Kendo\Test\ControllerTestCase;


/**
 * Class ProfileControllerTest
 *
 * @package Platform\User\Controller
 */
class ProfileControllerTest extends ControllerTestCase
{

    public function testActionIndex()
    {
        $this->dispatch('/tHoeger');

    }
}
