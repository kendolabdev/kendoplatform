<?php
namespace Platform\Blog\Block;

use Kendo\Layout\BlockController;

/**
 * Class ListingPosterBlock
 *
 * @package Base\Blog\Block
 */
class ListingPosterBlock extends BlockController
{

    /**
     * @var string
     */
    protected $basePath = 'platform/blog/block/blog-top-poster';

    /**
     *
     */
    public function execute()
    {
        parent::execute();

        $limit = $this->lp->get('limit', 5);

        $select = app()->table('platform_blog_post')
            ->select()
            ->where('poster_type=?', 'user')// fetch user only
            ->group('poster_id')
            ->order('item_count', -1)
            ->columns(['poster_id', 'count(post_id) as item_count'])
            ->limit($limit, 0);


        $agg = $select->toPairs('poster_id', 'item_count');

        $userIdList = array_keys($agg);

        $posters = app()->table('platform_user')
            ->findByIdList($userIdList);

        // ordering posters by item_count
        foreach ($posters as $poster) {
            $poster->__set('item_count', $agg[ $poster->getId() ]);
        }

        uasort($posters, function ($a, $b) {
            return $a->__get('item_count') < $b->__get('item_count') ? 1 : -1;
        });

        $this->view->assign([
            'posters' => $posters,
            'agg'     => $agg,
        ]);
    }

}
