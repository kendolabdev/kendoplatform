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
        $lp = \App::layouts()
            ->getHeaderLayoutParams();

        $script = $lp->script();

        if (\App::authService()->logged()) {
            $script .= '.logged';
        }

        $q = \App::requester()->getParam('q');

        $searchUrl = \App::routing()->getUrl('search', []);
        $siteName = \App::setting('core', 'site_name');

        if (!$siteName)
            $siteName = 'YouNet';

        $this->view->setScript($script)
            ->assign([
                'searchUrl' => $searchUrl,
                'q'         => $q,
                'siteName'  => $siteName,
                'viewer'    => \App::authService()->getViewer(),
                'logged'    => \App::authService()->logged(),
                'contact'   => \App::setting('contact'),
            ]);
    }
}