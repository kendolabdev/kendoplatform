<?php
namespace Platform\User\Block;

use Kendo\Layout\BlockController;

/**
 * Class EditProfileMenuBlock
 *
 * @package Platform\User\Block
 */
class EditProfileMenuBlock extends BlockController
{
    /**
     * @var string
     */
    protected $basePath = 'platform/user/block/edit-profile-menu';

    /**
     *
     */
    public function execute()
    {
        $this->view->assign([
        ]);
    }
}