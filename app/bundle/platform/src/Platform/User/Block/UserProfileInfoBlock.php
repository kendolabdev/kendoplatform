<?php
namespace Platform\User\Block;

use Kendo\Layout\BlockController;


/**
 * Class Platform\UserProfileInfoBlock
 *
 * @package Platform\User\Block
 */
class UserProfileInfoBlock extends BlockController
{

    /**
     * @var string
     */
    protected $basePath = 'platform/user/block/user-profile-info';

    /**
     * Load default listing by default order & default limit
     */
    public function execute()
    {
        $this->view->assign([
            'profile' => app()->registryService()->get('profile'),
        ]);
    }
}
