<?php
namespace Video\Block;

use Picaso\Layout\Block;


/**
 * Class ListingVideoItemBlock
 *
 * @package Video\Block
 */
class ListingVideoItemBlock extends Block
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