<?php
namespace Picaso\Paging;

/**
 * Class RenderNextPrev
 *
 * @package Picaso\Paging
 */
class RenderNextPrev implements RenderInterface
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

        $page = $this->paging->getPage();

        return \App::viewHelper()->partial('layout/partial/paging-next-prev', [
            'prevUrl' => $this->paging->getNextUrl(),
            'nextUrl' => $this->paging->getPrevUrl(),
            'hasNext' => $this->paging->hasNext(),
            'hasPrev' => $this->paging->hasPrev(),
            'paging'  => $this->paging,
        ]);
    }
}