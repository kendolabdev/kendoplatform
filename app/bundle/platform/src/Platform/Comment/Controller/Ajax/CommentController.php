<?php
namespace Platform\Comment\Controller\Ajax;

use Platform\Comment\Model\Comment;
use Kendo\Content\ContentInterface;
use Kendo\Controller\AjaxController;

/**
 * Class Base\CommentController
 *
 * @package Base\Comment\Controller\Ajax
 */
class CommentController extends AjaxController
{

    public function actionOptions()
    {
        list($eid, $id) = $this->request->getList('eid', 'id');

        $cmt = app()->commentService()->findComment($id);

        $this->response = [
            'html' => $this->partial('platform/comment/partial/comment-options', [
                'cmt' => $cmt,
                'eid' => $eid,
            ])];
    }

    public function actionRemove()
    {
        list($type, $id) = $this->request->getList('type', 'id');

        $cmt = app()->find($type, $id);

        if (!$cmt instanceof Comment)
            throw new \InvalidArgumentException();

        if (!$cmt->viewerIsPosterOrParent()) {
            throw new \InvalidArgumentException();
        }

        app()->commentService()->remove($cmt);

        $this->response = [
            'code' => 200,
        ];
    }

    /**
     *
     */
    public function actionAdd()
    {
        $item = app()->find($this->request->getString('type'), $this->request->getInt('id'));

        $poster = app()->auth()->getViewer();
        $parent = $poster;

        /**
         * item not found
         */
        if (!$item instanceof ContentInterface) {
            throw new \InvalidArgumentException();
        }

        $photoTemp = $this->request->getArray('photoTemp');
        $linkTmp = $this->request->getArray('link');
        $videoTmp = $this->request->getArray('video');
        $attachment = $this->request->getArray('attachment');

        $serviceName = null;
        $params = [];

        /**
         * process uploaded photo before check other
         */
        if (!empty($photoTemp)) {
            $serviceName = 'photo';
        }

        if (!empty($videoTmp)) {
            $serviceName = 'video';
        }

        if (!empty($linkTmp)) {
            $serviceName = 'link';
        }


        if (!empty($attachment['type'])) {
            if ($attachment['type'] == 'link' && !empty($linkTmp)) {
                $serviceName = 'link';
            } else if ($attachment['type'] == 'video' && !empty($videoTmp)) {
                $serviceName = 'video';
            }
        }

        if (!empty($serviceName)) {
            $callbackService = app()->instance()->make($serviceName);

            if (!method_exists($callbackService, 'addFromCommentComposer')) ;

            $attachItem = $callbackService->{'addFromCommentComposer'}($this->request, $poster, $parent);

            if ($attachItem instanceof ContentInterface) {
                $params = [
                    'attachment_type' => $attachItem->getType(),
                    'attachment_id'   => $attachItem->getId(),
                ];
            }
        }


        $commentTxt = $this->request->getString('commentTxt');

        /**
         * TODO check privacy
         */
        $comment = app()->commentService()->add($poster, $item, $commentTxt, $params);

        $html = $this->partial('platform/comment/partial/comment-item', [
            'comment'    => $comment,
            'poster'     => $poster,
            'attachment' => $comment->getAttachment(),
        ]);

        $this->response = [
            'result' => $comment->toArray(),
            'html'   => $html,
        ];
    }

    /**
     * View more comments
     */
    public function actionViewMore()
    {
        $type = $this->request->getString('type');
        $id = $this->request->getString('id');

        $about = app()->find($type, $id);

        $excludes = $this->request->getArray('excludes');

        $service = null;


        /**
         * get comment list for about with excules and supported params
         * + sort
         * + limit
         * + else where of others
         */

        $comments = app()->commentService()->getCommentList($about, 0, 0, null, $excludes);

        $order = app()->setting('activity', 'comment_sort');

        $this->response['html'] = app()->viewHelper()->partial('platform/comment/partial/comment-list', [
            'comments' => $comments,
            'about'    => $about,
            'viewer'   => app()->auth()->getViewer(),
        ]);

        $this->response['order'] = $order;
        $this->response['commentCount'] = (int)$about->getCommentCount();
        $this->response['cmds'] = app()->viewHelper()->lnViewMoreComment($about);
    }
}