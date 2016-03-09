<?php
namespace Platform\Photo\Block;

use Kendo\Layout\BlockController;

/**
 * Class ListingPhotoItemBlock
 *
 * @package Platform\Photo\Block
 */
class ListingPhotoItemBlock extends BlockController
{
    public function getTitle()
    {

        return 'Recent Platform\Photos';
    }

    /**
     *
     */
    public function execute()
    {
        $limit = $this->lp->get('limit', 5);

        $paging = app()->photoService()
            ->loadPhotoPaging([], 1, $limit);

        $this->view->assign([
            'paging' => $paging,
        ]);
    }
}