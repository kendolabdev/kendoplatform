<?php

namespace Platform\Storage\Form\Admin;

use Kendo\Html\Form;

/**
 * Class SelectStorage
 *
 * @package Platform\Storage\Form\Admin
 */
class SelectStorage extends Form
{
    /**
     *
     */
    protected function init()
    {

        $this->setMethod('get');

        $this->setAction(\App::routing()->getUrl('admin', ['stuff' => 'storage/manage/create']));

        $this->setTitle('core_form_storage_select.form_title');

        $adapters = \App::table('platform_storage_adapter')
            ->select()
            ->all();

        $options = [];

        foreach ($adapters as $adapter) {
            $options[] = [
                'value' => $adapter->getId(),
                'label' => $adapter->getName(),
            ];
        }

        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'adapter',
            'textKey'       => 'core_form_storage_select.select_adapter',
            'optionTextKey' => 0,
            'options'       => $options,
            'value'         => 'local',
        ]);

        $this->addElement([
            'plugin' => 'submit',
            'name'   => '_submit',
            'label'  => \App::text('core.continue'),
            'class'  => 'btn btn-primary btn-sm'
        ]);
    }
}