<?php
namespace Layout\Block;

use Kendo\Html\Form;
use Kendo\Layout\Block;

/**
 * Class SidebarFilterBlock
 *
 * @package Layout\Block
 */
class SidebarFilterBlock extends Block
{

    public function execute()
    {
        $filter = \App::layoutService()
            ->getPageFilter();

        if (!$filter instanceof Form) {
            $this->setNoRender(true);
        } else {
            $this->view->assign([
                'form' => $filter
            ]);
        }

    }
}