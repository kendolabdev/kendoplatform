<?php
namespace Platform\Report\Controller\Ajax;

use Kendo\Content\PosterInterface;
use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;
use Platform\Report\Form\AddGeneralReport;
use Platform\Report\Model\ReportGeneral;

/**
 * Class GeneralReportController
 *
 * @package Report\Controller\Ajax
 */
class GeneralReportController extends AjaxController
{
    /**
     * Report general data
     */
    public function actionDialog()
    {
        $form = new AddGeneralReport([]);

        $lp = new BlockParams([
            'base_path' => 'base/report/dialog/report-general',
        ]);

        $this->response = [
            'html'      => $this->partial($lp->script(), ['form' => $form, 'lp' => $lp]),
            'directive' => 'update',
        ];

    }

    /**
     * Add report
     */
    public function actionAdd()
    {
        list($message) = $this->request->get('message');

        $poster = \App::authService()->getViewer();

        if (!$poster instanceof PosterInterface) ;

        $params = [
        ];

        \App::reportService()->addGeneralReport($poster, $message, $params);

        $this->response = [
            'directive' => 'close',
        ];
    }

    /**
     * Delete report
     * input: type, id
     */
    public function actionDelete()
    {

        list($type, $id) = $this->request->get('type', 'id');

        $entry = \App::find($type, $id);

        if (!$entry instanceof ReportGeneral)
            throw new \InvalidArgumentException("Report does not exists!");

        $entry->delete();

        $this->response = [
            'message' => 'Deleted.',
        ];
    }
}