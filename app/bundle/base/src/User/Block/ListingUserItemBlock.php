<?php
namespace User\Block;

use Picaso\Layout\Block;

/**
 * Class ListingUserItemBlock
 *
 * @package User\Block
 */
class ListingUserItemBlock extends Block
{

    /**
     * Load default listing by default order & default limit
     */
    public function execute()
    {

        $limit = $this->lp->get('limit', 5);

        $paging = \App::user()->loadUserPaging([], 1, $limit);


        $this->view->assign([
            'paging'    => $paging,
            'canFriend' => false,
        ]);
    }
}