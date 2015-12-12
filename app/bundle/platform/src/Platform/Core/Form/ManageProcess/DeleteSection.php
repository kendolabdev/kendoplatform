<?php
namespace Platform\Core\Form\ManageProcess;

use Kendo\Html\Form;

/**
 * Class DeleteSection
 *
 * @package Core\Form\ManageProcess
 */
class DeleteSection extends Form
{

    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('manage_process_delete_section.form_title');

        $this->setNote('manage_process_delete_section.form_note');
    }
}