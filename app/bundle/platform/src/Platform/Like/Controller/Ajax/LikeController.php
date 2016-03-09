<?php
namespace Platform\Like\Controller\Ajax;

use Kendo\Content\AtomInterface;
use Kendo\Controller\AjaxController;
use Kendo\Layout\BlockParams;
use Kendo\View\View;

/**
 * Class LikeController
 *
 * @package Like\Controller\Ajax
 */
class LikeController extends AjaxController
{
    public function actionMembershipLikeToggle()
    {
        $type = $this->request->getString('type');
        $id = $this->request->getInt('id');

        $about = app()->find($type, $id);

        if (!$about instanceof AtomInterface) {
            throw new \InvalidArgumentException();
        }

        $poster = app()->auth()->getViewer();

        $likeService = app()->likeService();

        $likeService->toggle($poster, $about);


        $this->response = [
            'html' => $about->btnMembership(),
        ];
    }

    /**
     * Like an object
     */
    public function actionToggle()
    {
        $type = $this->request->getString('type');
        $id = $this->request->getInt('id');

        $about = app()->find($type, $id);

        if (!$about instanceof AtomInterface)
            throw new \InvalidArgumentException();

        $poster = app()->auth()->getViewer();

        $likeService = app()->likeService();

        $likeService->toggle($poster, $about);


        /**
         * Refresh about object
         */
        $about = app()->find($type, $id, false);


        $likeResult = $likeService->getLikeResult($poster, $about, 2);

        $sample = $likeResult->getSampleHtml();

        $this->response['label'] = $likeResult->isLiked() ? app()->text('core.unlike') : app()->text('core.like');
        $this->response['sample'] = $sample;
        $this->response['hasSample'] = $sample != "";
        $this->response['likeCount'] = $about->getLikeCount();
        $this->response['liked'] = $likeResult->isLiked();

    }

    /**
     * Like an object
     */
    public function actionAdd()
    {
        $object = app()->find($this->request->getString('type'), $this->request->getInt('id'));

        $context = $this->request->getString('context', 'label');

        $viewer = app()->auth()->getViewer();

        $likeService = app()->likeService();

        $followService = app()->followService();

        $likeService->add($viewer, $object);

        if ($context == 'btn') {

            $likeStatus = $likeService->getLikeStatus($viewer, $object->getId());
            $followStatus = $followService->getFollowStatus($viewer, $object->getId());

            $this->response['html'] = (new View(
                '/platform/core/partial/like-btn',
                [
                    'item'         => $object,
                    'likeStatus'   => $likeStatus,
                    'followStatus' => $followStatus
                ]
            ))->render();

        } else {
            $this->response['label'] = app()->text('core.unlike');

        }
    }


    /**
     * Like an object
     */
    public function actionRemove()
    {
        $object = app()->find($this->request->getString('type'), $this->request->getInt('id'));

        $context = $this->request->getString('context', 'label');

        $viewer = app()->auth()->getViewer();

        $likeService = app()->likeService();

        $followService = app()->followService();

        $likeService->remove($viewer, $object);

        if ($context == 'btn') {
            $likeStatus = $likeService->getLikeStatus($viewer, $object->getId());
            $followStatus = $followService->getFollowStatus($viewer, $object->getId());

            $this->response['html'] = (new View(
                '/platform/core/partial/like-btn',
                [
                    'item'         => $object,
                    'likeStatus'   => $likeStatus,
                    'followStatus' => $followStatus
                ]
            ))->render();
        } else {
            $this->response['label'] = app()->text('core.like');
        }
    }

    /**
     *
     */
    public function actionLikedThis()
    {
        list($id, $type) = $this->request->getList('id', 'type');

        $about = app()->find($type, $id);

        $page = 1;

        $query = [
            'aboutId'   => $about->getId(),
            'aboutType' => $about->getType(),
        ];

        $paging = app()->likeService()
            ->loadLikedThisPaging($query, $page);

        $lp = app()->layouts()
            ->getContentLayoutParams('like_ajax_dialog_liked_this');

        $lp->set('endless', true);

        $html = $this->partial($lp->script(), [
            'pagingUrl' => 'ajax/platform/like/like/liked-this-paging',
            'paging'    => $paging,
            'lp'        => $lp,
            'query'     => $query,
        ]);

        $this->response = [
            'html' => $html
        ];
    }

    public function actionLikedThisPaging()
    {
        $page = $this->request->getParam('page', 1);
        $query = $this->request->getArray('query');

        $paging = app()->likeService()->loadLikedThisPaging($query, $page);

        $lp = new BlockParams($this->request->getParam('lp'));

        $html = $this->partial($lp->itemScript(), [
            'paging' => $paging,
            'lp'     => $lp
        ]);

        $this->response = [
            'html'    => $html,
            'pager'   => $paging->getPager(),
            'query'   => $query,
            'hasNext' => $paging->hasNext(),
            'hasPrev' => $paging->hasPrev(),
        ];
    }

}