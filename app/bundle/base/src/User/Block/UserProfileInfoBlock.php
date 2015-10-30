<?php
namespace User\Block;

use Picaso\Layout\Block;


/**
 * Class UserProfileInfoBlock
 *
 * @package User\Block
 */
class UserProfileInfoBlock extends Block
{

    /**
     * @var string
     */
    protected $basePath = 'base/user/block/user-profile-info';

    /**
     * Load default listing by default order & default limit
     */
    public function execute()
    {
        $this->view->assign([
            'profile' => \App::registry()->get('profile'),
        ]);
    }
}
