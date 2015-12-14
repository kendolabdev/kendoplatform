<?php
namespace Kendo\Kernel;

/**
 * Class UniqueIdProvider
 *
 * @package Kendo\Kernel
 */
class UniqueIdProvider extends KernelServiceAgreement
{

    /**
     *
     */
    const MIN_NEXT_ID = 1000;

    /**
     * @var UniqueIdGeneratorInterface
     */
    protected $generator;

    /**
     * @return int
     */
    public function nextId()
    {
        $nextId = $this->getGenerator()->nextId();

        if ($nextId < self::MIN_NEXT_ID) {
            $this->getGenerator()->setNextId(self::MIN_NEXT_ID);
        }

        return $nextId;
    }

    /**
     * @return UniqueIdGeneratorInterface
     */
    public function getGenerator()
    {
        if (null == $this->generator) {
            $this->generator = new DbUniqueIdGenerator();
        }

        return $this->generator;
    }
}