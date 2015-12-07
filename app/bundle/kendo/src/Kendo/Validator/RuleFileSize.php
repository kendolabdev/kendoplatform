<?php
namespace Kendo\Validator;

/**
 * Class RuleFileSize
 *
 * @package Kendo\Validator
 */
class RuleFileSize extends Rule
{

    /**
     * @var int
     */
    private $minSize = 0;

    /**
     * @var int
     */
    private $maxSize = 0;

    /**
     * @return int
     */
    public function getMinSize()
    {
        return $this->minSize;
    }

    /**
     * @param int $minSize
     */
    public function setMinSize($minSize)
    {
        $this->minSize = $minSize;
    }

    /**
     * @return int
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }

    /**
     * @param int $maxSize
     */
    public function setMaxSize($maxSize)
    {
        $this->maxSize = $maxSize;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        if ($this->value == 0) {
            return false;
        }
        if ($this->minSize > 0 && $this->minSize > $this->value) {
            return false;
        }

        if ($this->maxSize > 0 && $this->maxSize < $this->value) {
            return false;
        }

        return true;
    }
}