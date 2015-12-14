<?php

namespace Platform\Core\Service;

use Kendo\Kernel\KernelServiceAgreement;
use Platform\Core\Model\Block;
use Kendo\Content\PosterInterface;


/**
 * Class BlockService
 *
 * @package Activity\Service
 */
class BlockService extends KernelServiceAgreements
{

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $object
     *
     * @return \Platform\Core\Model\Block
     */
    public function findBlock($poster, $object)
    {
        return \App::table('core.block')
            ->select()
            ->where('poster_id=?', $poster->getId())
            ->where('object_id=?', $object->getId())
            ->one();
    }

    /**
     * Toggle Block status
     *
     * @param PosterInterface $poster
     * @param PosterInterface $object
     *
     * @return bool
     */
    public function toggle(PosterInterface $poster, PosterInterface $object)
    {

        $block = $this->findBlock($poster, $object);

        if ($block) {
            $this->remove($poster, $object, $block);

            return false;
        }

        $this->add($poster, $object);

        return true;
    }

    /**
     * @param PosterInterface $poster
     * @param PosterInterface $object
     *
     * @return Block
     * @throws \InvalidArgumentException
     */
    public function add(PosterInterface $poster, PosterInterface $object)
    {

        /**
         * block the same content
         */
        if ($object->getId() == $poster->getId()
            && $object->getType() == $poster->getType()
        ) {
            throw new \InvalidArgumentException("Could not block your self");
        }

        $block = $this->findBlock($poster, $object);

        if (null == $block) {
            $block = new Block([
                'object_id'   => $object->getId(),
                'poster_id'   => $poster->getId(),
                'object_type' => $object->getType(),
                'poster_type' => $poster->getType(),
                'created_at'  => KENDO_DATE_TIME,
            ]);
            $block->save();
        }

        return $block;

    }

    /**
     * Remove $poster blocked $object
     *
     * @param PosterInterface $poster
     * @param PosterInterface $object
     * @param Block           $block
     *
     * @return bool
     */
    public function remove(PosterInterface $poster, PosterInterface $object, Block $block = null)
    {
        if (null == $block) {
            $block = $this->findBlock($poster, $object);
        }

        if (null != $block) {
            $block->delete();
        }

        return true;
    }

    /**
     * Is $poster blocked $object
     *
     * @param PosterInterface $poster
     * @param PosterInterface $object
     *
     * @return bool
     */
    public function isBlocked(PosterInterface $poster, PosterInterface $object)
    {

        return null != $this->findBlock($poster, $object);
    }
}