<?php

namespace User\Form;

use Picaso\Html\Form;

class UserCreateAvatar extends Form
{

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('Setup your avatar');

        $this->addElement([
            'plugin' => 'editavatar',
            'name'   => 'avatar',
        ]);
    }
}