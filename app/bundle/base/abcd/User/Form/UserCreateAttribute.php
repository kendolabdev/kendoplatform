<?php

namespace User\Form;

use Attribute\Form\AttributeCustomForm;


/**
 * Class UserCreateAttribute
 *
 * @package User\Form
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