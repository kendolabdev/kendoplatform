<?php
namespace Platform\User\Block;

use Kendo\Layout\Block;


/**
 * Class Platform\UserProfileInfoBlock
 *
 * @package Platform\User\Block
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
            'profile' => \App::registryService()->get('profile'),
        ]);
    }
}
