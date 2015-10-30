<?php
namespace Core\Controller\Ajax;

use Picaso\Controller\AjaxController;
use User\Model\User;

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

        $select = \App::table('user')
            ->select()
            ->limit(20, 0);

        $poster = \App::auth()->getViewer();

        if ($poster != null) {
            $select->where('user_id<>?', $poster->getId());
        }

        $q = $this->request->getString('q');

        $ids = \App::relation()->getMemberIdList($poster, 'user');

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