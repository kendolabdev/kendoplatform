<?php
namespace Report\Controller\Ajax;

use Picaso\Content\Poster;
use Picaso\Controller\AjaxController;
use Picaso\Layout\BlockParams;
use Report\Form\AddGeneralReport;
use Report\Model\ReportGeneral;

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

        $poster = \App::auth()->getViewer();

        if (!$poster instanceof Poster) ;

        $params = [
        ];

        \App::report()->addGeneralReport($poster, $message, $params);

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