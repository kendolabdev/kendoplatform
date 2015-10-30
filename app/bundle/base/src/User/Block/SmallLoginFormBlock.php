<?php
namespace User\Block;

use Picaso\Layout\Block;

/**
 * Class SmallLoginFormBlock
 *
 * @package User\Block
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
        if (\App::auth()->logged()) {

            $this->setNoRender(true);

            return false;
        }

        $services = \App::table('social.social_service')
            ->select()
            ->where('is_active=?', 1)
            ->order('sort_order', 1)
            ->all();

        $form = \App::html()->factory('\User\Form\AuthLoginSmall');

        $this->view->assign([
            'form'        => $form,
            'showService' => !empty($services),
            'services'    => $services,
        ]);
    }
}