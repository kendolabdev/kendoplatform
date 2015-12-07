<?php
namespace User\Block;

use Kendo\Layout\Block;

/**
 * Class EditProfileMenuBlock
 *
 * @package User\Block
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
        $steps = \App::service('core.process')->getUniqueSteps('user', 'edit');

        $this->view->assign([
            'steps' => $steps,
        ]);
    }
}