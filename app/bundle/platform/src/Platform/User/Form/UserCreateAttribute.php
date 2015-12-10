<?php

namespace Platform\User\Form;

use Platform\Catalog\FormAttributeCustomForm;


/**
 * Class Platform\UserCreateAttribute
 *
 * @package Platform\User\Form
 */
class UserCreateAttribute extends AttributeCustomForm
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('Profile Information');
    }
}