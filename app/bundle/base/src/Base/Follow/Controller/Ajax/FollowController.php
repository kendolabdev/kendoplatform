<?php
namespace Base\Follow\Controller\Ajax;

use Base\Feed\Model\Feed;
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

        $object = \App::find($type, $id);

        $poster = \App::authService()->getViewer();

        if (!$object instanceof PosterInterface) ;

        \App::followService()->toggle($poster, $object);

        $this->response['html'] = \App::viewHelper()->btnFollow($object, null, $ctx);
    }

    /**
     * Switch subscribe for this post
     */
    public function actionLinkToggle()
    {
        list($type, $id) = $this->request->get('type', 'id');

        $item = \App::find($type, $id);

        $viewer = \App::authService()->getViewer();

        $followService = \App::followService();

        if ($item instanceof PosterInterface) {
            $poster = $item;
        } else {
            $poster = $item->getPoster();
        }


        $followService->toggle($viewer, $poster);

        $following = $followService->isFollowed($viewer, $poster);
        $vars = ['following' => $following];

        if ($item instanceof Feed) {
            $script = 'base/follow/partial/toggle-follow-feed';
            if ($following) {
                $vars['followLabel'] = \App::text('core.unfollow_$poster', ['$poster' => substr($poster->getTitle(), 0, 15)]);
            } else {
                $vars['followLabel'] = \App::text('core.follow_$poster', ['$poster' => substr($poster->getTitle(), 0, 15)]);
            }
        } else {
            $script = 'base/follow/partial/toggle-follow';
            if ($following) {
                $vars['followLabel'] = \App::text('core.following');
            } else {
                $vars['followLabel'] = \App::text('core.follow');
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
        $object = \App::find($this->request->getString('type'), $this->request->getInt('id'));

        $followService = \App::followService();

        $poster = \App::authService()->getViewer();

        if (!$object instanceof PosterInterface) ;

        $followService->remove($poster, $object);

        $this->response['label'] = \App::text('core.follow');
    }

    /**
     * follow
     */
    public function actionAdd()
    {
        $object = \App::find($this->request->getString('type'), $this->request->getInt('id'));

        $followService = \App::followService();

        $poster = \App::authService()->getViewer();

        if (!$object instanceof PosterInterface) ;

        $followService->add($poster, $object);

        $this->response['label'] = \App::text('core.unfollow');
    }

}
