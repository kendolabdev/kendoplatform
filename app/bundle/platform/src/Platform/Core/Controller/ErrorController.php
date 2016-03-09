<?php

namespace Platform\Core\Controller;

use Kendo\Acl\AuthorizationRestrictException;
use Kendo\Acl\PrivacyRestrictException;
use Kendo\Controller\DefaultController;

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

        $pageName = 'platform_core_error_general_exception';

        if ($exception instanceof AuthorizationRestrictException) {
            $pageName = 'platform_core_error_authorization_restrict';
        } else if ($exception instanceof PrivacyRestrictException) {
            $pageName = 'platform_core_error_privacy_restrict';
            app()->layouts()
                ->setPageName('platform_core_error_privacy_restrict');
        }

        $lp = app()->layouts()
            ->getContentLayoutParams($pageName);

        app()->layouts()
            ->setPageName($pageName);

        $this->view->setScript($lp)
            ->assign(['exception' => $exception]);

    }
}