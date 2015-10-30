<?php
namespace User\Block;

use Picaso\Layout\Block;

/**
 * Class ListingBlock
 *
 * @package User\Block
 */
class ListingBlock extends Block
{

    /**
     * @var string
     */
    protected $basePath = 'base/user/block/user-listing';

    /**
     * Load default listing by default order & default limit
     */
    public function execute()
    {
        $select = \App::table('user')
            ->select('u')
            ->where('is_active=?', 1)
            ->where('is_published=?', 1)
            ->where('is_approved=?', 1)
            ->order('created_at', -1);

        $paging = $select->paging(1, 10);

        $this->view->assign([
            'paging'    => $paging,
            'canFriend' => false,
        ]);
    }
}
