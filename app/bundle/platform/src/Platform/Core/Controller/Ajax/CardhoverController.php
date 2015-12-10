<?php
namespace Platform\Core\Controller\Ajax;

use Kendo\Controller\AjaxController;

/**
 * Class CardhoverController
 *
 * @package Core\Controller\Ajax
 */
class CardhoverController extends AjaxController
{
    /**
     *
     */
    public function actionPreview()
    {
        $cardInfo = $this->request->getString('cardInfo');

        list($id, $type) = explode('@', $cardInfo);

        $item = \App::find($type, $id);

        $this->response['cardInfo'] = $cardInfo;

        $this->response['html'] = '<div class="cardhover-body">Conba no muon gi vay may ... ' . $cardInfo . '</div>';
    }
}