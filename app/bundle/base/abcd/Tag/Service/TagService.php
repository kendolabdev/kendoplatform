<?php
namespace Tag\Service;

use Kendo\Content\ContentInterface;
use Kendo\Content\PosterInterface;
use Tag\Model\TagPeople;

/**
 * Class TagService
 *
 * @package Tag\Service
 */
class TagService
{
    /**
     * @param ContentInterface $content
     * @param array            $people
     *
     * @return int total number of people tagedContentInterface
     * @throws \Exception
     */
    public function tagPeople(ContentInterface $content, $people)
    {
        $idList = [];

        foreach ($people as $poster) {
            if (is_string($poster)) {
                list($id, $type) = explode('@', $poster);
                $idList[ $type ][] = $id;
            }
        }

        $table = \App::table('tag.tag_people');

        //delete all tags.
        $table->delete()
            ->where('content_id=?', $content->getId())
            ->execute();

        if (empty($idList)) {
            return 0;
        }

        $peopleCount = 0;

        foreach ($idList as $type => $list) {
            try {
                foreach (\App::table($type)->findByIdList($list) as $poster) {
                    if ($poster instanceof PosterInterface) {
                        $people = new TagPeople([
                            'content_id'   => $content->getId(),
                            'content_type' => $content->getType(),
                            'poster_id'    => $poster->getId(),
                            'poster_type'  => $poster->getType(),
                        ]);

                        $people->save();

                        ++$peopleCount;
                    }
                }
            } catch (\Exception $e) {
                throw $e;
            }
        }

        return $peopleCount;
    }

    /**
     * @param ContentInterface $content
     * @param int              $limit
     *
     * @return array
     */
    public function loadPeople(ContentInterface $content, $limit = null)
    {
        $select = \App::table('tag.tag_people')
            ->select()
            ->where('content_id=?', $content->getId());

        if ($limit) {
            $select->limit($limit, 0);
        }

        $pairs = $select->toPairs('poster_id', 'poster_type');

        $idList = [];

        foreach ($pairs as $id => $type) {
            $idList[ $type ][] = $id;
        }

        foreach ($idList as $type => $list) {
            foreach (\App::table($type)->findByIdList($list) as $item) {
                if ($item instanceof PosterInterface) {
                    $id = $item->getId();
                    $pairs[ $id ] = $item;
                }
            }
        }

        foreach ($pairs as $id => $item) {
            if (is_string($item)) {
                unset($pairs[ $id ]);
            }
        }

        return $pairs;
    }
}