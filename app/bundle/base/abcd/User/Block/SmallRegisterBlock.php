<?php
namespace User\Block;

use Kendo\Layout\Block;

/**
 * Class SmallRegisterBlock
 *
 * @package User\Block
 */
class SmallRegisterBlock extends Block
{
    /**
     * Execute block layout
     */
    public function execute()
    {
        if (\App::authService()->logged()) {

            $this->setNoRender(true);

            return false;
        }

        $services = \App::table('social.social_service')
            ->select()
            ->where('is_active=?', 1)
            ->order('sort_order', 1)
            ->all();

        $form = \App::htmlService()->factory('\User\Form\UserCreateAccount');

        $this->view->assign([
            'note'        => $this->lp->get('note', ''),
            'form'        => $form,
            'showService' => !empty($services),
            'services'    => $services,
        ]);
    }
}