<?php
namespace Picaso\Paging;

/**
 * Class LoadMoreDecorator
 *
 * @package Picaso\Paging
 */
class LoadMoreDecorator implements Decorator
{

    /**
     * @var PagingInterface
     */
    private $paging;

    /**
     * @var array
     */
    private $options = [];

    /**
     * @param PagingInterface $paging
     * @param array           $options
     */
    public function __construct(PagingInterface $paging, $options)
    {
        $this->paging = $paging;
        $this->options = array_merge($this->options, $options);

    }

    /**
     * Render paging to html code
     *
     * @return string
     */
    public function render()
    {
        return \App::viewHelper()->partial('layout/partial/paging-more', [
            'hasNext'   => $this->paging->hasNext(),
            'pageCount' => $this->paging->pageCount(),
            'itemCount' => $this->paging->count(),
            'paging'    => $this->paging,
        ]);
    }
}