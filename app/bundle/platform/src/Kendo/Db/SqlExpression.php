<?php
namespace Kendo\Db;

/**
 * Class SqlExpression
 *
 * @package Kendo\Db
 */
class SqlExpression
{
    /**
     * @var string
     */
    private $expression;

    /**
     * @param $expression
     */
    public function __construct($expression)
    {
        $this->expression = (string)$expression;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->expression;
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;
    }

}