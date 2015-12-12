<?php
/**
 *
 * User: namnv
 * Date: 4/13/15
 * Time: 6:45 PM
 */
namespace Kendo\Db;

/**
 * Class QueryResultMysqli
 *
 * @package Kendo\Db
 */
class QueryResultMysqli implements QueryResult
{
    /**
     * @var \mysqli_result
     */
    protected $_result;

    /**
     * @var string
     */
    protected $_model;

    /**
     * @param \mysqli_result $result
     */
    public function __construct(\mysqli_result $result)
    {
        $this->_result = $result;
    }

    /**
     * @return array [ [], ]
     */
    public function all()
    {
        if (null == $this->_model) {
            return $this->toAssocs();
        }

        $response = [];

        $class = $this->_model;

        while (null != ($row = mysqli_fetch_assoc($this->_result))) {
            $response[] = new $class($row, true);
        }

        return $response;
    }

    /**
     * @return array [[ key: value], .. ]
     */
    public function toAssocs()
    {
        $response = [];

        while (null != ($row = mysqli_fetch_assoc($this->_result))) {
            $response[] = $row;
        }

        return $response;
    }

    /**
     * @return \Kendo\Model
     */
    public function one()
    {
        if (null == $this->_model) {
            return $this->toAssoc();
        }

        $row = mysqli_fetch_assoc($this->_result);

        if (!empty($row)) {
            $class = $this->_model;

            return new $class($row, true);
        }

        return null;
    }

    /**
     * @return array [key: value]
     */
    public function toAssoc()
    {
        return mysqli_fetch_assoc($this->_result);
    }

    /**
     * @param  string $column
     *
     * @return int
     */
    public function toInt($column)
    {
        $row = mysqli_fetch_assoc($this->_result);

        if (!empty($row)) {
            return (int)$row[ $column ];
        }

        return 0;
    }

    /**
     * @param  string $column
     *
     * @return int
     */
    public function toInts($column)
    {
        $response = [];
        $column = (string)$column;

        while (null != ($row = mysqli_fetch_assoc($this->_result))) {
            $response[] = (int)$row[ $column ];
        }

        return $response;
    }

    /**
     * @return \mysqli_result
     */
    public function getResult()
    {
        return $this->_result;
    }

    /**
     * @param \mysqli_result $result
     */
    public function setResult($result)
    {
        $this->_result = $result;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * @param string $model
     *
     * @return QueryResult
     */
    public function setModel($model)
    {
        $this->_model = $model;

        return $this;
    }

    /**
     * @param $column
     *
     * @return array
     */
    public function fields($column)
    {
        $response = [];

        while (null != ($row = mysqli_fetch_assoc($this->_result))) {
            $response[] = $row[ $column ];
        }

        return $response;
    }

    /**
     * @param string $column
     *
     * @return string
     */
    public function field($column)
    {

        if (null != ($row = mysqli_fetch_assoc($this->_result))) {
            return $row[ $column ];
        }

        return '';
    }

    /**
     * @param string $keyColumn
     * @param string $valueColumn
     *
     * @return array
     */
    public function toPairs($keyColumn, $valueColumn)
    {
        $response = [];

        while (null != ($row = mysqli_fetch_assoc($this->_result))) {
            $response[ $row[ $keyColumn ] ] = $row[ $valueColumn ];
        }

        return $response;
    }


}