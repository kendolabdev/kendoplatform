<?php
namespace Layout\Block;

use Picaso\Layout\Block;

/**
 * Class SiteHeaderBlock
 *
 * @package Layout\Block
 */
class SiteHeaderBlock extends Block
{
    /**
     * Override this method to execute this block by page manager
     *
     * @return bool
     */
    public function execute()
    {
        $lp = \App::layout()
            ->getHeaderLayoutParams();

        $script = $lp->script();

        if (\App::auth()->logged()) {
            $script .= '.logged';
        }

        $q = \App::request()->getInitiator()->getParam('q');

        $searchUrl = \App::routing()->getUrl('search', []);
        $siteName = \App::setting('core', 'site_name');

        if (!$siteName)
            $siteName = 'YouNet';

        $this->view->setScript($script)
            ->assign([
                'searchUrl' => $searchUrl,
                'q'         => $q,
                'siteName'  => $siteName,
                'viewer'    => \App::auth()->getViewer(),
                'logged'    => \App::auth()->logged(),
                'contact'   => \App::setting('contact'),
            ]);
    }
}