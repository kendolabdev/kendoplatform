<?php

namespace Platform\Message\Controller\Ajax;

use Kendo\Content\PosterInterface;
use Kendo\Controller\AjaxController;

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

        if (!$person instanceof PosterInterface) {
            throw new \InvalidArgumentException("Could not find person");
        }

        $poster = \App::authService()->getViewer();

        $this->response['html'] = \App::viewHelper()->partial('/base/message/partial/chat-popup', [
            'person' => $person,
            'owner'  => $poster,
        ]);
    }
}