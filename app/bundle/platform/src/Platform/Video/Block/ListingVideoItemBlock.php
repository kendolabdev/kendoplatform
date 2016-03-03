<?php
namespace Platform\Video\Block;

use Kendo\Layout\BlockController;


/**
 * Class ListingVideoItemBlock
 *
 * @package Video\Block
 */
class ListingVideoItemBlock extends BlockController
{
    /**
     *
     */
    public function execute()
    {
        $limit = $this->lp->get('limit', 5);

        $paging = \App::videoService()
            ->loadVideoPaging([], 1, $limit);

        $this->view->assign([
            'paging' => $paging,
        ]);
    }
}