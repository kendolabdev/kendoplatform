<?php
namespace Platform\Core\Block;

use Kendo\Layout\BlockController;

/**
 * Class AclGroupsBlock
 *
 * @package Core\Block
 */
class AclGroupsBlock extends BlockController
{

    /**
     * @var string
     */
    protected $basePath = 'platform/core/block/acl-groups';

    /**
     *
     */
    public function execute()
    {
        $groups = \App::table('platform_acl_group')
            ->select()
            ->all();

        $this->view->assign([
            'groups' => $groups
        ]);

    }
}