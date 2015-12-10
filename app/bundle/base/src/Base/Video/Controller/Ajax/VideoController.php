<?php
namespace Base\Video\Controller\Ajax;

use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;
use Base\Video\Model\Video;

/**
 * Class VideoController
 *
 * @package Video\Controller\Ajax
 */
class VideoController extends AjaxController
{

    public function actionPaging()
    {
        $page = $this->request->getParam('page', 1);

        $query = $this->request->getArray('query');

        $paging = \App::videoService()->loadVideoPaging($query, $page);

        $lp = new BlockParams($this->request->getParam('lp'));

        $html = $this->partial($lp->itemScript(), [
            'paging' => $paging,
            'lp'     => $lp
        ]);

        $this->response = [
            'html'    => $html,
            'pager'   => $paging->getPager(),
            'query'   => $query,
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
        ];
    }

    /**
     * Get embed code for a specific video
     */
    public function actionEmbed()
    {
        $width = $this->request->getParam('width', 500);

        $videoId = $this->request->getParam('id');

        $video = \App::find('video', $videoId);

        if (!$video instanceof Video) ;

        $this->response['html'] = $video->getEmbedCode(['width' => $width]);

    }
}