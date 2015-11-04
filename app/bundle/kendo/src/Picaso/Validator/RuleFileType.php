<?php
namespace Picaso\Validator;

/**
 * Class RuleFileType
 *
 * @package Picaso\Validator
 */
class RuleFileType extends Rule
{

    /**
     * @var array
     */
    private $accepts = [];

    /**
     * @return bool
     */
    public function validate()
    {
        return true;
    }

    /**
     * @return array
     */
    public function getAccepts()
    {
        return $this->accepts;
    }

    /**
     * @param array $accepts
     */
    public function setAccepts($accepts)
    {
        $this->accepts = $accepts;
    }
}