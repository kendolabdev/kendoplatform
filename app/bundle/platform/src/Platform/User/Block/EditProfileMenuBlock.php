<?php
namespace Platform\User\Block;

use Kendo\Layout\Block;

/**
 * Class EditProfileMenuBlock
 *
 * @package Platform\User\Block
 */
class EditProfileMenuBlock extends Block
{
    /**
     * @var string
     */
    protected $basePath = 'base/user/block/edit-profile-menu';

    /**
     *
     */
    public function execute()
    {
        $this->view->assign([
        ]);
    }
}