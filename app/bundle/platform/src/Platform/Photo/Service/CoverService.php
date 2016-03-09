<?php
namespace Platform\Photo\Service;

use Platform\Photo\Model\PhotoCover;
use Platform\Photo\Model\Photo;
use Kendo\Content\AtomInterface;


/**
 * Class CoverService
 *
 * @package Platform\Photo\Service
 */
class CoverService
{

    /**
     * @param AtomInterface $object
     *
     * @return \Platform\Photo\Model\PhotoCover
     */
    private function findCoverByObject(AtomInterface $object)
    {
        return app()->table('photo.cover')
            ->select()
            ->where('object_id=?', $object->getId())
            ->where('object_type=?', $object->getType())
            ->one();
    }

    /**
     * @param AtomInterface $object
     *
     * @return \Platform\Photo\Model\PhotoCover
     */
    public function getCover(AtomInterface $object)
    {
        return $this->findCoverByObject($object);
    }

    /**
     * @param AtomInterface               $object
     * @param \Platform\Photo\Model\Photo $photo
     * @param int                         $positionTop
     *
     * @return \Platform\Photo\Model\PhotoCover
     */
    public function setCover(AtomInterface $object, Photo $photo, $positionTop = 0)
    {
        $cover = $this->findCoverByObject($object);

        if (null == $cover) {
            $cover = new PhotoCover(
                [
                    'object_id'   => $object->getId(),
                    'object_type' => $object->getType(),
                ]
            );
        }

        // update Platform\PhotoCover information
        $cover->setPositionTop($positionTop);
        $cover->setPhotoFileId($photo->getPhotoFileId());
        $cover->setPhotoId($photo->getId());
        $cover->setCreatedAt(KENDO_DATE_TIME);

        $cover->save();

        return $cover;
    }

    /**
     * @param AtomInterface $object
     * @param               $positionTop
     *
     * @return bool
     */
    public function updatePosition(AtomInterface $object, $positionTop)
    {
        $cover = $this->findCoverByObject($object);

        if (null == $cover) {
            throw new \InvalidArgumentException("Cover not found");
        }

        $cover->setPositionTop($positionTop);

        $cover->save();

        return true;
    }

    /**
     * @param AtomInterface $object
     *
     * @return bool
     */
    public function removeCover(AtomInterface $object)
    {

        $cover = $this->findCoverByObject($object);

        if (null != $cover) {
            $cover->delete();
        }

        return true;
    }

    /**
     * @param AtomInterface $object
     * @param int           $positionTop
     *
     * @return \Platform\Photo\Model\PhotoCover
     * @throws \InvalidArgumentException
     */
    public function repositionCover(AtomInterface $object, $positionTop)
    {

        $cover = $this->findCoverByObject($object);

        if (empty($cover)) {
            throw new \InvalidArgumentException("Cover not found");
        }

        $cover->setPositionTop($positionTop);
        $cover->save();

        return $cover;
    }
}