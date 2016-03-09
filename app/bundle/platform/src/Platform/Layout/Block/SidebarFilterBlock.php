<?php
namespace Platform\Layout\Block;

use Kendo\Html\Form;
use Kendo\Layout\BlockController;

/**
 * Class SidebarFilterBlock
 *
 * @package Platform\Layout\Block
 */
class SidebarFilterBlock extends BlockController
{

    public function execute()
    {
        $filter = app()->layouts()
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