<?php
namespace Photo\Block;

use Picaso\Layout\Block;

/**
 * Class ListingPhotoItemBlock
 *
 * @package Photo\Block
 */
class ListingPhotoItemBlock extends Block
{
    public function getTitle()
    {

        return 'Recent Photos';
    }

    /**
     *
     */
    public function execute()
    {
        $limit = $this->lp->get('limit', 5);

        $paging = \App::photo()
            ->loadPhotoPaging([], 1, $limit);

        $this->view->assign([
            'paging' => $paging,
        ]);
    }
}