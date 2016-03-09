<?php
namespace Platform\Blog\Block;

use Kendo\Layout\BlockController;


/**
 * Class ListingBlogItemBlock
 *
 * @package Base\Blog\Block
 */
class ListingBlogItemBlock extends BlockController
{
    /**
     *
     */
    public function execute()
    {
        $limit = $this->lp->get('limit', 5);

        $paging = app()->blogService()
            ->loadPostPaging([], 1, $limit);

        $this->view->assign([
            'paging' => $paging,
        ]);
    }
}