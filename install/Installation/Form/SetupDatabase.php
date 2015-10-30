<?php

namespace Installation\Form;

use Picaso\Html\Form;

class SetupDatabase extends Form
{
    protected function init()
    {
        $this->setTitle('Setup Database');
        $this->setNote('Create database then complete following information!');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'host',
            'label'    => 'Host',
            'required' => true,
            'class'    => 'form-control',
            'value'    => 'localhost',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'port',
            'label'    => 'Port',
            'required' => true,
            'class'    => 'form-control',
            'value'    => '3306',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'prefix',
            'label'    => 'Prefix',
            'required' => true,
            'class'    => 'form-control',
            'value'    => 'picaso_',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'database',
            'label'    => 'Database',
            'required' => true,
            'class'    => 'form-control',
            'value'    => '',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'usr_name',
            'label'    => 'Username',
            'required' => true,
            'class'    => 'form-control',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'usr_pwd',
            'label'    => 'Password',
            'required' => true,
            'class'    => 'form-control',
        ]);

    }
}