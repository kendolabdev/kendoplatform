<?php
namespace Platform\Core\Form\ManageProcess;

use Kendo\Html\Form;

/**
 * Class EditField
 *
 * @package Core\Form\ManageProcess
 */
class EditField extends Form
{
    /**
     * @var \Platform\Core\Model\ProcessField
     */
    protected $field;

    /**
     *
     */
    protected function init()
    {
        parent::init();

        $field = $this->getField();

        $section = $field->getSection();

        $stepId = $section->getStepId();

        $this->setTitle('manage_process_form_field.form_title');

        $this->setNote('manage_process_form_field.form_note');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'field_name',
            'required' => true,
            'label'    => 'manage_process_form_field.field_name_label',
            'note'     => 'manage_process_form_field.field_name_note',
            'disabled' => true,
        ]);

        $this->addElement([
            'plugin'   => 'radio',
            'name'     => 'section_id',
            'label'    => 'manage_process_form_field.section_label',
            'note'     => 'manage_process_form_field.section_note',
            'required' => true,
            'options'  => app()->instance()->make('platform_core_process')->getSectionOptions($stepId),
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_active',
            'label'  => 'manage_process_form_field.active_label',
            'note'   => 'manage_process_form_field.active_note',
            'value'  => '0'
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_required',
            'label'  => 'manage_process_form_field.required_label',
            'note'   => 'manage_process_form_field.required_note',
            'value'  => '0'
        ]);


        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'plugin_id',
            'label'         => 'manage_process_form_field.plugin_label',
            'note'          => 'manage_process_form_field.plugin_note',
            'required'      => true,
            'value'         => 'text',
            'optionTextKey' => 'core.form_plugin_opt_',
            'options'       => app()->instance()->make('platform_core_process')->getPluginOptions(),
        ]);
    }

    /**
     * @return \Platform\Core\Model\ProcessField
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param \Platform\Core\Model\ProcessField $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

}