<?php
namespace Video\Controller\Ajax;

use Picaso\Controller\AjaxController;
use Picaso\Layout\BlockParams;
use Video\Model\Video;

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

        $paging = \App::video()->loadVideoPaging($query, $page);

        $lp = new BlockParams($this->request->getParam('lp'));

        $this->response = [
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
            'query'   => $query,
            'pager'   => $paging->getPager(),
            'html'    => $this->partial('base/video/paging/browse-video', ['paging' => $paging, 'lp' => $lp]),
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