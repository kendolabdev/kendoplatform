<?php
namespace Platform\Report\Controller\Ajax;

use Platform\Feed\Model\Feed;
use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;
use Platform\Report\Form\AddReport;
use Platform\Report\Model\Report;

/**
 * Class ReportController
 *
 * @package Report\Controller\Ajax
 */
class ReportController extends AjaxController
{

    /**
     * Show report dialog
     */
    public function actionDialog()
    {
        list($type, $id) = $this->request->getList('type', 'id');

        $about = \App::find($type, $id);

        if (null == $about)
            throw new \InvalidArgumentException("Invalid Report Item");

        $form = new AddReport([
            'about' => $about,
        ]);

        $lp = new BlockParams([
            'base_path' => 'platform/report/dialog/report-about',
        ]);

        $html = $this->partial($lp->script(), ['form'  => $form,
                                               'about' => $about,
                                               'lp'    => $lp]);

        $this->response = [
            'html'      => $html,
            'directive' => 'update',
        ];
    }

    /**
     * Add report
     */
    public function actionAdd()
    {
        list($aboutType, $aboutId, $message, $categoryId) = $this->request->getList('aboutType', 'aboutId', 'message', 'category_id');

        $about = \App::find($aboutType, $aboutId);

        $poster = \App::authService()->getViewer();

        // validate content

        if (!$about instanceof ContentInterface && !$about instanceof Feed)
            throw new \InvalidArgumentException();


        if (!$poster instanceof PosterInterface) ;

        $data = [
            'message'     => (string)$message,
            'category_id' => intval($categoryId),
        ];


        \App::reportService()->addReport($poster, $about, $data);

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

        list($type, $id) = $this->request->getList('type', 'id');

        $entry = \App::find($type, $id);

        if (!$entry instanceof Report)
            throw new \InvalidArgumentException("Report does not exists!");

        $entry->delete();

        $this->response = [
            'message' => 'Deleted.',
        ];
    }

    /**
     * Delete report
     * input: type, id
     */
    public function actionDeleteContent()
    {

        list($type, $id) = $this->request->getList('type', 'id');

        $entry = \App::find($type, $id);

        if (!$entry instanceof Report)
            throw new \InvalidArgumentException("Report does not exists!");

        $about = $entry->getAbout();

        if ($about) {
            $about->delete();
        }

        $entry->delete();

        $this->response = [
            'message' => 'Deleted.',
        ];
    }
}