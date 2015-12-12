<?php
/**
 * Created by PhpStorm.
 * User: namnv
 * Date: 12/11/15
 * Time: 11:32 PM
 */

namespace Platform\Acl\Controller\Admin;


use Kendo\Test\ControllerTestCase;

class ManageControllerTest extends ControllerTestCase
{


    public function testIndex()
    {
        $this->dispatch('admin/platform/acl/manage/browse');
    }
}
