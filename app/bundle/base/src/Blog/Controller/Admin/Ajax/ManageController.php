<?php
namespace Blog\Controller\Admin\Ajax;

use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;


/**
 * Class ManageController
 *
 * @package Blog\Controller\Admin\Ajax
 */
class ManageController extends AjaxController
{


    /**
     * Paging ajax pattern
     */
    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);

        $query = $this->request->getArray('query');

        $paging = \App::blogService()->loadAdminPostPaging($query, $page);

        $lp = new BlockParams($this->request->getParam('lp'));

        $html = $this->partial($lp->itemScript(), ['paging' => $paging, 'lp' => $lp]);

        $this->response = [
            'html' => $html,
        ];
    }

    public function actionOptions()
    {
        $id = $this->request->getParam('id');
        $eid = $this->request->getParam('eid');
        $entry = \App::blogService()->findPostById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Entry not found");

        $html = $this->partial('base/blog/partial/admin/post-options', [
            'item' => $entry,
            'eid'  => $eid,
        ]);

        $this->response = [
            'html' => $html,
            'eid'  => $eid,
        ];
    }

    /**
     *
     */
    public function actionDelete()
    {
        $id = $this->request->getParam('id');

        $entry = \App::blogService()->findPostById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Entry not found");

        $entry->delete();

        $this->response = [
            'html'    => '',
            'success' => 'Post is deleted',
        ];
    }

    public function actionApprove()
    {
        $id = $this->request->getParam('id');

        $entry = \App::blogService()->findPostById($id);

        if (!$entry)
            throw new \InvalidArgumentException("Entry not found");

        $entry->setApproved(1);
        $entry->save();

        $this->response = [
            'html'    => '',
            'success' => 'Approved',
        ];
    }
}