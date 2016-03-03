<?php
namespace Platform\User\Block;

use Kendo\Layout\BlockController;

/**
 * Class ListingUserItemBlock
 *
 * @package Platform\User\Block
 */
class ListingUserItemBlock extends BlockController
{

    /**
     * Load default listing by default order & default limit
     */
    public function execute()
    {

        $limit = $this->lp->get('limit', 5);

        $paging = \App::userService()->loadUserPaging([], 1, $limit);


        $this->view->assign([
            'paging'    => $paging,
            'canFriend' => false,
        ]);
    }
}
