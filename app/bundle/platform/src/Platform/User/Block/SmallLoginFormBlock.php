<?php
namespace Platform\User\Block;

use Kendo\Layout\BlockController;

/**
 * Class SmallLoginFormBlock
 *
 * @package Platform\User\Block
 */
class SmallLoginFormBlock extends BlockController
{
    /**
     * @var string
     */
    protected $basePath = 'platform/user/block/login';

    /**
     * Execute block layout
     */
    public function execute()
    {
        if (app()->auth()->logged()) {

            $this->setNoRender(true);

            return;
        }

        $services = app()->table('platform_social_service')
            ->select()
            ->where('is_active=?', 1)
            ->order('sort_order', 1)
            ->all();

        $form = app()->html()->factory('\Platform\User\Form\AuthLoginSmall');

        $this->view->assign([
            'form'        => $form,
            'showService' => !empty($services),
            'services'    => $services,
        ]);
    }
}