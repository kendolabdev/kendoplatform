<?php
namespace Blog\Controller\Ajax;

use Picaso\Controller\AjaxController;


/**
 * Class PostController
 *
 * @package Blog\Controller\Ajax
 */
class PostController extends AjaxController
{


    /**
     * Paging ajax pattern
     */
    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);

        $query = $this->request->getArray('query');

        $paging = \App::blog()->loadPostPaging($query, $page);

        $script = 'base/blog/partial/blog-post-paging';

        $this->response['html'] = $this->partial($script, ['paging' => $paging]);
    }
}