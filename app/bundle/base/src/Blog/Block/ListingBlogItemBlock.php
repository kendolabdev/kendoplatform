<?php
namespace Blog\Block;

use Kendo\Layout\Block;


/**
 * Class ListingBlogItemBlock
 *
 * @package Blog\Block
 */
class ListingBlogItemBlock extends Block
{
    /**
     *
     */
    public function execute()
    {
        $limit = $this->lp->get('limit', 5);

        $paging = \App::blogService()
            ->loadPostPaging([], 1, $limit);

        $this->view->assign([
            'paging' => $paging,
        ]);
    }
}