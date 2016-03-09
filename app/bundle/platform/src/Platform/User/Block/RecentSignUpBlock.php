<?php

namespace Platform\User\Block;

use Kendo\Layout\BlockController;

/**
 * Class RecentSignUpBlock
 *
 * @package Platform\User\Block
 */
class RecentSignUpBlock extends BlockController
{

    /**
     * List action top of default value
     */
    public function execute()
    {
        $select = app()->table('platform_user')
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