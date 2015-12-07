<?php
namespace Photo\Service;

use Photo\Model\PhotoCover;
use Photo\Model\Photo;
use Kendo\Content\AtomInterface;


/**
 * Class PhotoCoverService
 *
 * @package Photo\Service
 */
class PhotoCoverService
{

    /**
     * @param AtomInterface $object
     *
     * @return PhotoCover
     */
    private function findCoverByObject(AtomInterface $object)
    {
        return \App::table('photo.cover')
            ->select()
            ->where('object_id=?', $object->getId())
            ->where('object_type=?', $object->getType())
            ->one();
    }

    /**
     * @param AtomInterface $object
     *
     * @return PhotoCover
     */
    public function getCover(AtomInterface $object)
    {
        return $this->findCoverByObject($object);
    }

    /**
     * @param AtomInterface $object
     * @param Photo         $photo
     * @param int           $positionTop
     *
     * @return PhotoCover
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

        // update PhotoCover information
        $cover->setPositionTop($positionTop);
        $cover->setPhotoFileId($photo->getPhotoFileId());
        $cover->setPhotoId($photo->getId());
        $cover->setCreatedAt(Kendo_DATE_TIME);

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
     * @return PhotoCover
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