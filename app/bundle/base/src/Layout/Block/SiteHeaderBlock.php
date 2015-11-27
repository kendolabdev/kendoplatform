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
        $lp = \App::layoutService()
            ->getHeaderLayoutParams();

        $script = $lp->script();

        if (\App::authService()->logged()) {
            $script .= '.logged';
        }

        $q = \App::requestService()->getInitiator()->getParam('q');

        $searchUrl = \App::routingService()->getUrl('search', []);
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