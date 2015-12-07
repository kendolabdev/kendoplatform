<?php
namespace Core\Form\ManageProcess;

use Kendo\Html\Form;

/**
 * Class DeleteField
 *
 * @package Core\Form\ManageProcess
 */
class DeleteField extends Form
{

    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('manage_process_delete_field.form_title');

        $this->setNote('manage_process_delete_field.form_note');
    }
}