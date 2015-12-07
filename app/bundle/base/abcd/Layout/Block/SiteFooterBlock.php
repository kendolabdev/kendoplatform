<?php
namespace Layout\Block;

use Kendo\Layout\Block;

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
        $lp = \App::layoutService()
            ->getFooterLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'contact' => \App::setting('contact'),
            ]);
    }
}