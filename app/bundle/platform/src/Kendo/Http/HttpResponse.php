<?php

namespace Kendo\Http;

/**
 * Class SimpleResponse
 *
 * @package Kendo\Response
 */
class HttpResponse
{
    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $content = '';

    /**
     * @var string
     */
    protected $redirect;

    /**
     * HttpResponse constructor.
     *
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Reset header & content & others.
     */
    public function reset()
    {
        $this->headers = [];
        $this->content = '';
        $this->redirect = '';
    }

    /**
     * @return string
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param string $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function flush()
    {
        try {
            if ($this->request->isAjaxFragment()) {
                $json = json_encode([
                    'directive' => 'update',
                    'title'     => \App::assetService()->title()->toText(),
                    'html'      => \App::layouts()->render('/layout/master/site-ow')
                ]);
                echo '<script type="text/javascript">window.parent.onFetchPageComplete(' . $json . ')</script>';
            } else
                if ($this->request->isAjax()) {
                    return $this->getContent();
                } else {
                    echo \App::layouts()->render();
                }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}