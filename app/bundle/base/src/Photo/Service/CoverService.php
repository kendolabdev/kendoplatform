<?php
namespace Photo\Service;

use Photo\Model\Cover;
use Photo\Model\Photo;
use Picaso\Content\HasCover;


/**
 * Class CoverService
 *
 * @package Photo\Service
 */
class CoverService
{

    /**
     * @param HasCover $object
     *
     * @return Cover
     */
    private function findCoverByObject(HasCover $object)
    {
        return \App::table('photo.cover')
            ->select()
            ->where('object_id=?', $object->getId())
            ->where('object_type=?', $object->getType())
            ->one();
    }

    /**
     * @param HasCover $object
     *
     * @return Cover
     */
    public function getCover(HasCover $object)
    {
        return $this->findCoverByObject($object);
    }

    /**
     * @param HasCover $object
     * @param Photo    $photo
     * @param int      $positionTop
     *
     * @return Cover
     */
    public function setCover(HasCover $object, $photo, $positionTop = 0)
    {
        $cover = $this->findCoverByObject($object);

        if (null == $cover) {
            $cover = new Cover(
                [
                    'object_id'   => $object->getId(),
                    'object_type' => $object->getType(),
                ]
            );
        }

        // update cover information
        $cover->setPositionTop($positionTop);
        $cover->setPhotoFileId($photo->getPhotoFileId());
        $cover->setPhotoId($photo->getId());
        $cover->setCreatedAt(PICASO_DATE_TIME);

        $cover->save();

        return $cover;
    }

    /**
     * @param HasCover $object
     * @param          $positionTop
     *
     * @return bool
     */
    public function updatePosition(HasCover $object, $positionTop)
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
     * @param HasCover $object
     *
     * @return bool
     */
    public function removeCover(HasCover $object)
    {

        $cover = $this->findCoverByObject($object);

        if (null != $cover) {
            $cover->delete();
        }

        return true;
    }

    /**
     * @param HasCover $object
     * @param int      $positionTop
     *
     * @return Cover
     * @throws \InvalidArgumentException
     */
    public function repositionCover(HasCover $object, $positionTop)
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