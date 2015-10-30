<?php

namespace Core\Service;

use Core\Model\Block;
use Picaso\Content\Poster;


/**
 * Class BlockService
 *
 * @package Activity\Service
 */
class BlockService
{

    /**
     * @param Poster $poster
     * @param Poster $object
     *
     * @return \Core\Model\Block
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
     * @param Poster $poster
     * @param Poster $object
     *
     * @return bool
     */
    public function toggle(Poster $poster, Poster $object)
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
     * @param Poster $poster
     * @param Poster $object
     *
     * @return Block
     * @throws \InvalidArgumentException
     */
    public function add(Poster $poster, Poster $object)
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
                'created_at'  => PICASO_DATE_TIME,
            ]);
            $block->save();
        }

        return $block;

    }

    /**
     * Remove $poster blocked $object
     *
     * @param Poster $poster
     * @param Poster $object
     * @param Block  $block
     *
     * @return bool
     */
    public function remove(Poster $poster, Poster $object, Block $block = null)
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
     * @param Poster $poster
     * @param Poster $object
     *
     * @return bool
     */
    public function isBlocked(Poster $poster, Poster $object)
    {

        return null != $this->findBlock($poster, $object);
    }
}