<?php
namespace Core\Form\ManageProcess;

use Picaso\Html\Form;

/**
 * Class AddStep
 *
 * @package Core\Form\ManageProcess
 */
class AddStep extends Form
{
    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('manage_process_form_step.form_add_title');

        $this->setNote('manage_process_form_step.form_add_note');

        $this->addElement([
            'plugin'    => 'text',
            'name'      => 'step_name',
            'label'     => 'manage_process_form_step.step_name_label',
            'note'      => 'manage_process_form_step.step_name_note',
            'required'  => true,
            'maxlength' => 20,
        ]);

        $this->addElement([
            'plugin'   => 'yesno',
            'name'     => 'is_active',
            'label'    => 'manage_process_form_step.active_label',
            'note'     => 'manage_process_form_step.active_note',
            'value'    => '1',
            'required' => true,
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'step_number',
            'label'    => 'manage_process_form_step.step_number_label',
            'note'     => 'manage_process_form_step.step_number_note',
            'value'    => '1',
            'required' => true,
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'sort_order',
            'label'    => 'manage_process_form_step.sort_order_label',
            'note'     => 'manage_process_form_step.sort_order_note',
            'value'    => '1',
            'required' => true,
        ]);
    }

}