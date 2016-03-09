<?php
namespace Platform\Follow\Controller\Ajax;

use Platform\Feed\Model\Feed;
use Kendo\Content\PosterInterface;
use Kendo\Controller\AjaxController;

/**
 * Class FollowController
 *
 * @package Follow\Controller\Ajax
 */
class FollowController extends AjaxController
{

    /**
     * un-follow
     */
    public function actionToggle()
    {
        $type = $this->request->getString('type');
        $id = $this->request->getInt('id');
        $ctx = $this->request->getString('ctx', 'label');

        $object = app()->find($type, $id);

        $poster = app()->auth()->getViewer();

        if (!$object instanceof PosterInterface) ;

        app()->followService()->toggle($poster, $object);

        $this->response['html'] = app()->viewHelper()->btnFollow($object, null, $ctx);
    }

    /**
     * Switch subscribe for this post
     */
    public function actionLinkToggle()
    {
        list($type, $id) = $this->request->getList('type', 'id');

        $item = app()->find($type, $id);

        $viewer = app()->auth()->getViewer();

        $followService = app()->followService();

        if ($item instanceof PosterInterface) {
            $poster = $item;
        } else {
            $poster = $item->getPoster();
        }


        $followService->toggle($viewer, $poster);

        $following = $followService->isFollowed($viewer, $poster);
        $vars = ['following' => $following];

        if ($item instanceof Feed) {
            $script = 'platform/follow/partial/toggle-follow-feed';
            if ($following) {
                $vars['followLabel'] = app()->text('core.unfollow_$poster', ['$poster' => substr($poster->getTitle(), 0, 15)]);
            } else {
                $vars['followLabel'] = app()->text('core.follow_$poster', ['$poster' => substr($poster->getTitle(), 0, 15)]);
            }
        } else {
            $script = 'platform/follow/partial/toggle-follow';
            if ($following) {
                $vars['followLabel'] = app()->text('core.following');
            } else {
                $vars['followLabel'] = app()->text('core.follow');
            }
        }

        $this->response = [
            'html' => $this->partial($script, $vars)
        ];
    }

    /**
     * un-follow
     */
    public function actionRemove()
    {
        $object = app()->find($this->request->getString('type'), $this->request->getInt('id'));

        $followService = app()->followService();

        $poster = app()->auth()->getViewer();

        if (!$object instanceof PosterInterface) ;

        $followService->remove($poster, $object);

        $this->response['label'] = app()->text('core.follow');
    }

    /**
     * follow
     */
    public function actionAdd()
    {
        $object = app()->find($this->request->getString('type'), $this->request->getInt('id'));

        $followService = app()->followService();

        $poster = app()->auth()->getViewer();

        if (!$object instanceof PosterInterface) ;

        $followService->add($poster, $object);

        $this->response['label'] = app()->text('core.unfollow');
    }

}
