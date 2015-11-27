<?php

namespace Core\Controller;

use Picaso\Acl\AuthorizationRestrictException;
use Picaso\Acl\PrivacyRestrictException;
use Picaso\Controller\DefaultController;
use Picaso\Layout\BlockParams;

/**
 * Class ErrorController
 *
 * @package Core\Controller
 */
class ErrorController extends DefaultController
{
    /**
     * Always pass network mode
     *
     * @return bool
     */
    protected function passNetworkBrowseMode()
    {
        return true;
    }

    /**
     * Always pass maintenance mode
     *
     * @return bool
     */
    protected function passMaintenanceMode()
    {
        return true;
    }


    /**
     * Page not found
     */
    public function action404()
    {
        $this->prepareRenderByContentLayoutParams();
    }

    /**
     *
     */
    public function actionException()
    {
        $exception = $this->request->getException();

        $pageName = 'core_error_general_exception';

        if ($exception instanceof AuthorizationRestrictException) {
            $pageName = 'core_error_authorization_restrict';
        } else if ($exception instanceof PrivacyRestrictException) {
            $pageName = 'core_error_privacy_restrict';
            \App::layoutService()
                ->setPageName('core_error_privacy_restrict');
        }

        $lp = \App::layoutService()
            ->getContentLayoutParams($pageName);

        \App::layoutService()
            ->setPageName($pageName);

        $this->view->setScript($lp)
            ->assign(['exception' => $exception]);

    }
}