<?php
namespace Platform\Layout\Block;

use Kendo\Layout\BlockController;

/**
 * Class SiteHeaderBlock
 *
 * @package Platform\Layout\Block
 */
class SiteHeaderBlock extends BlockController
{
    /**
     * Override this method to execute this block by page manager
     *
     * @return bool
     */
    public function execute()
    {
        $lp = app()->layouts()
            ->getHeaderLayoutParams();

        $script = $lp->script();

        if (app()->auth()->logged()) {
            $script .= '.logged';
        }

        $q = app()->requester()->getParam('q');

        $searchUrl = app()->routing()->getUrl('search', []);
        $siteName = app()->setting('core', 'site_name');

        if (!$siteName)
            $siteName = 'YouNet';

        $this->view->setScript($script)
            ->assign([
                'searchUrl' => $searchUrl,
                'q'         => $q,
                'siteName'  => $siteName,
                'viewer'    => app()->auth()->getViewer(),
                'logged'    => app()->auth()->logged(),
                'contact'   => app()->setting('contact'),
            ]);
    }
}