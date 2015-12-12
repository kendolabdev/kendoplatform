<?php
namespace Platform\User\Block;

use Kendo\Layout\Block;

/**
 * Class SmallLoginFormBlock
 *
 * @package Platform\User\Block
 */
class SmallLoginFormBlock extends Block
{
    /**
     * @var string
     */
    protected $basePath = 'base/user/block/login';

    /**
     * Execute block layout
     */
    public function execute()
    {
        if (\App::authService()->logged()) {

            $this->setNoRender(true);

            return;
        }

        $services = \App::table('base_social_service')
            ->select()
            ->where('is_active=?', 1)
            ->order('sort_order', 1)
            ->all();

        $form = \App::htmlService()->factory('\Platform\User\Form\AuthLoginSmall');

        $this->view->assign([
            'form'        => $form,
            'showService' => !empty($services),
            'services'    => $services,
        ]);
    }
}