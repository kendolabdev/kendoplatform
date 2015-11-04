<?php
namespace Picaso\Paging;

/**
 * Class PagingArray
 *
 * @package Picaso\Paging
 */
class PagingArray implements PagingInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var int
     */
    protected $limit = 10;

    /**
     * @var
     */
    protected $totalItemCount;

    /**
     * @var int
     */
    protected $totalPageCount;

    /**
     * @var array
     */
    protected $itemArray;

    /**
     * @var string
     */
    protected $routeName;

    /**
     * @var array
     */
    protected $routeParams;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param int $pageNumber
     * @param int $limit
     *
     * @return PagingSqlSelect
     */
    public function paging($pageNumber, $limit)
    {
        $pageNumber = (int)$pageNumber;

        if ($pageNumber < 1) {
            $pageNumber = 1;
        }

        $limit = (int)$limit;

        if ($limit < 1) {
            $limit = 10;
        }

        $this->page = $pageNumber;

        $this->limit = $limit;

        return $this;
    }

    /**
     * @return array
     */
    public function items()
    {
        if (null === $this->itemArray) {
            $offset = ($this->page - 1) * $this->limit;

            $this->itemArray = array_slice($this->data, $offset, $this->limit);
        }

        return $this->itemArray;
    }

    /**
     * @param int $pageNumber
     *
     * @return PagingInterface
     */
    public function setPage($pageNumber)
    {
        if ($pageNumber < 1) {
            $pageNumber = 1;
        }

        $this->page = intval($pageNumber);

        return $this;
    }

    /**
     * @param $limit
     *
     * @return PagingInterface
     */
    public function setLimit($limit)
    {
        if ($limit < 1)
            $limit = 5;

        $this->limit = intval($limit);

        return $this;
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return PagingInterface
     */
    public function setRouting($name, $params)
    {
        $this->routeName = $name;
        $this->routeParams = $params;
    }

    /**
     * @return bool
     */
    public function hasNext()
    {

        return $this->getPage() < $this->pageCount();
    }

    /**
     * @return int
     */
    public function getPage()
    {
        if ($this->page < 1) {
            $this->page = 1;
        }

        return $this->page;
    }

    /**
     * @return int
     */
    public function pageCount()
    {
        if (null == $this->totalPageCount) {
            $this->totalPageCount = ceil($this->count() / $this->getLimit());
        }

        return $this->totalPageCount;
    }

    /**
     * @return int
     */
    public function count()
    {
        if (null === $this->totalItemCount) {
            $this->totalItemCount = count($this->data);
        }

        return $this->totalItemCount;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        if (!$this->limit) {
            $this->limit = 10;
        }

        return $this->limit;
    }

    /**
     * @return bool
     */
    public function hasPrev()
    {
        return $this->getPage() > 1;
    }

    /**
     * @return string
     */
    public function getNextUrl()
    {
        return $this->getUrl($this->getPage() + 1);
    }

    /**
     * @param $pageNumber
     *
     * @return string
     */
    public function getUrl($pageNumber)
    {
        if (null == $this->routeName) {
            list($this->routeName, $this->routeParams) = \App::request()->getRouting();
        }
        $params = $this->routeParams;

        $params['page'] = $pageNumber;

        return \App::routing()->getUrl($this->routeName, $params);
    }

    /**
     * @return string
     */
    public function getPrevUrl()
    {
        return $this->getUrl($this->getPage() - 1);
    }

    /**
     * @param string $name
     * @param array  $options
     *
     * @return string
     *
     */
    public function toHtml($name = 'nextPrev', $options = [])
    {
        return \App::paging()->getRender($name, ['paging' => $this], $this)->render();
    }

    public function noLimit()
    {
        $this->setLimit($this->count());
    }

    /**
     *
     */
    public function getPager()
    {
        return [
            'page'      => $this->getPage(),
            'totalPage' => $this->pageCount(),
            'totalItem' => $this->count(),
        ];
    }

}