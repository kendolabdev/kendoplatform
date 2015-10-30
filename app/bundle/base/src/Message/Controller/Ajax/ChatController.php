<?php

namespace Message\Controller\Ajax;

use Picaso\Content\Poster;
use Picaso\Controller\AjaxController;

/**
 * Class ChatController
 *
 * @package Message\Controller\Ajax
 */
class ChatController extends AjaxController
{
    /**
     * open chat modal
     */
    public function actionOpen()
    {
        $type = $this->request->getString('type');
        $id = $this->request->getString('id');

        $person = \App::find($type, $id);

        if (!$person instanceof Poster) {
            throw new \InvalidArgumentException("Could not find person");
        }

        $poster = \App::auth()->getViewer();

        $this->response['html'] = \App::viewHelper()->partial('/base/message/partial/chat-popup', [
            'person' => $person,
            'owner'  => $poster,
        ]);
    }
}