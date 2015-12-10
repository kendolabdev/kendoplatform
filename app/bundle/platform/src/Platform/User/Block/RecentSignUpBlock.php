<?php

namespace Platform\User\Block;

use Kendo\Layout\Block;

/**
 * Class RecentSignUpBlock
 *
 * @package Platform\User\Block
 */
class RecentSignUpBlock extends Block
{

    /**
     * List action top of default value
     */
    public function execute()
    {
        $select = \App::table('platform_user')
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