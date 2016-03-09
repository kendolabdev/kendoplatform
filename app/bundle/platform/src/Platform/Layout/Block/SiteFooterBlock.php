<?php
namespace Platform\Layout\Block;

use Kendo\Layout\BlockController;

/**
 * Class SiteFooterBlock
 *
 * @package Platform\Layout\Block
 */
class SiteFooterBlock extends BlockController
{
    /**
     * Override this method to execute this block by page manager
     *
     * @return bool
     */
    public function execute()
    {
        $lp = app()->layouts()
            ->getFooterLayoutParams();

        $this->view->setScript($lp)
            ->assign([
                'contact' => app()->setting('contact'),
            ]);
    }
}