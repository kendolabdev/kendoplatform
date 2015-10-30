<?php
namespace Core\Block;

use Picaso\Layout\Block;

/**
 * Class AclGroupsBlock
 *
 * @package Core\Block
 */
class AclGroupsBlock extends Block
{

    /**
     * @var string
     */
    protected $basePath = 'base/core/block/acl-groups';

    /**
     *
     */
    public function execute()
    {
        $groups = \App::table('acl.acl_group')
            ->select()
            ->all();

        $this->view->assign([
            'groups' => $groups
        ]);

    }
}