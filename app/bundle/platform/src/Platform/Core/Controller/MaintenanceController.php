<?php
namespace Platform\Core\Controller;

use Kendo\Controller\DefaultController;

/**
 * Class MaintenanceController
 *
 * @package Core\Controller
 */
class MaintenanceController extends DefaultController
{
    /**
     * Always pass network browse mode
     *
     * @return bool
     */
    protected function passNetworkBrowseMode()
    {
        return true;
    }

    /**
     * Always pass for maintenance mode
     * Prevent loop.
     *
     * @return bool
     */
    protected function passMaintenanceMode()
    {
        return true;
    }

    /**
     * Show offline mode view.
     *
     */
    public function actionIndex()
    {
        if ($this->request->getParam('code') == \App::setting('core', 'maintenance_code')) {
            $_SESSION['maintenance'] = $this->request->getParam('code');

            \App::routing()->redirect('home');
        }

        \App::layouts()
            ->setMasterScript('layout/master/blank');

        $lp = \App::layouts()
            ->getContentLayoutParams();

        $this->view
            ->setScript($lp)
            ->assign([]);
    }
}