<?php
namespace Layout\Block;

use Picaso\Layout\Block;

/**
 * Class SiteFooterBlock
 *
 * @package Layout\Block
 */
class SiteFooterBlock extends Block
{
    /**
     * Override this method to execute this block by page manager
     *
     * @return bool
     */
    public function execute()
    {
        $lp = \App::layout()
            ->getFooterLayoutParams();

        $script = $lp->script();

        if (\App::registry()->get('is_admin')) {
            $script = 'base/layout/block/site-footer/render-admin';
        }

        $this->view->setScript($script)
            ->assign([
                'contact' => \App::setting('contact'),
            ]);
    }
}