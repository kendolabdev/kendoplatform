<?php
namespace Layout\Block;

use Picaso\Html\Form;
use Picaso\Layout\Block;

/**
 * Class SidebarFilterBlock
 *
 * @package Layout\Block
 */
class SidebarFilterBlock extends Block
{

    public function execute()
    {
        $filter = \App::layout()
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