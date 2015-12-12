<?php
namespace Platform\Core\Controller\Ajax;

use Kendo\Controller\AjaxController;

/**
 * Class LinkController
 *
 * @package Core\Controller\Ajax
 */
class LinkController extends AjaxController
{

    /**
     * composer preview
     */
    public function actionComposerPreview()
    {
        $url = $this->request->getParam('url');

        if (strpos($url, 'http') !== 0) {
            $url = "http://" . $url;
        }

        $data = $this->_parse($url);

        if (!$data) {
            $this->response['html'] = '';
            $this->response['code'] = 404;

            // escape continue working
            return;
        }

        $this->response['data'] = $data;
        $this->response['code'] = 200;

        if ($data['link_type'] == 'video') {
            $data['duration'] = \App::trans()->toDuration($data['video_duration']);

        }

        $this->response['html'] = \App::viewHelper()
            ->partial('platform/core/controller/ajax/link/composer-preview-link', $data);
    }

    /**
     * @param $url
     *
     * @return mixed
     * [ 'url'=> string,
     *   'title'=> string,
     *   'description'=> string,
     *   'provider_name'=> string,
     *   'thumbnail_url'=>string,
     *   'images'=>[],
     * ']
     * @throws \Exception
     */
    private function _parse($url)
    {
        if (function_exists('libxml_use_internal_errors')) {
            libxml_use_internal_errors(true);
        }

        $data = null;

        try {
            $data = \App::videoService()->parseFromUrl($url);

            $data = $data->toArray();

            $data['link_type'] = 'video';

        } catch (\Exception $e) {
//            throw $e;
        }

        if (empty($data)) {
            $data = \App::linkService()->parseEmbedly($url);
        }

        if (empty($data)) {
            $data = \App::linkService()->parseUrl($url);
        }

        return $data;
    }
}