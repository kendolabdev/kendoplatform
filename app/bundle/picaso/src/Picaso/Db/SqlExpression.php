<?php
namespace Picaso\Db;

/**
 * Class SqlExpression
 *
 * @package Picaso\Db
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