<?php
namespace Platform\Core\Controller\Ajax;

use Kendo\Controller\AjaxController;
use Platform\User\Model\User;

/**
 * Class SuggestController
 *
 * @package Core\Controller\Ajax
 */
class SuggestController extends AjaxController
{
    /**
     *
     */
    public function actionList()
    {

        $select = app()->table('platform_user')
            ->select()
            ->limit(20, 0);

        $poster = app()->auth()->getViewer();

        if ($poster != null) {
            $select->where('user_id<>?', $poster->getId());
        }

        $q = $this->request->getString('q');

        $ids = app()->relation()->getMemberIdList($poster, 'user');

        if (empty($ids)) {
            $ids = [0];
        }

        $select->where('user_id IN ?', $ids);

        if (!empty($q)) {
            $select->where('name like ?', "%{$q}%");
        }

        $users = $select->all();

        foreach ($users as $user) {
            if (!$user instanceof User) continue;

            $this->response[] = [
                'id'   => $user->getId(),
                'type' => $user->getType(),
                'name' => $user->getTitle(),
                'img'  => $user->getPhoto('avatar_xs'),
            ];
        }
    }
}