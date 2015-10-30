<?php
namespace Installation\Form;

use Picaso\Html\Form;

class SetupAccount extends Form
{
    protected function init()
    {
        $this->setTitle('Setup Account');

        $this->setNote('Create super administrator account!');

        $this->addElement([
            'plugin'      => 'text',
            'required'    => true,
            'name'        => 'name',
            'class'       => 'form-control',
            'label'       => 'Name',
            'placeholder' => 'Name',
            'value'       => 'Admin',
        ]);

        $this->addElement([
            'plugin'      => 'text',
            'required'    => true,
            'name'        => 'username',
            'class'       => 'form-control',
            'label'       => 'Username',
            'placeholder' => 'Username',
            'value'       => 'admin',
        ]);

        $this->addElement([
            'plugin'      => 'text',
            'required'    => true,
            'name'        => 'email',
            'class'       => 'form-control',
            'label'       => 'Email',
            'placeholder' => 'Email',
        ]);

        $this->addElement([
            'plugin'      => 'password',
            'required'    => true,
            'name'        => 'password',
            'class'       => 'form-control',
            'label'       => 'Password',
            'placeholder' => 'Password',
        ]);

        $this->addElement([
            'plugin'      => 'password',
            'required'    => true,
            'name'        => 'password2',
            'class'       => 'form-control',
            'label'       => 'Re-Enter Password',
            'placeholder' => 'Re-Enter Password',
        ]);
    }
}