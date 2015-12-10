<?php
namespace Platform\Core\Form\ManageProcess;

use Kendo\Html\Form;

/**
 * Class AddStep
 *
 * @package Core\Form\ManageProcess
 */
class AddField extends Form
{
    /**
     * @var int
     */
    protected $stepId;

    /**
     *
     */
    protected function init()
    {
        parent::init();

        $stepId = $this->getStepId();

        $this->setTitle('manage_process_form_field.form_title');

        $this->setNote('manage_process_form_field.form_note');

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'field_name',
            'required' => true,
            'label'    => 'manage_process_form_field.field_name_label',
            'note'     => 'manage_process_form_field.field_name_note',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_active',
            'label'  => 'manage_process_form_field.active_label',
            'note'   => 'manage_process_form_field.active_note',
            'value'  => '1'
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_required',
            'label'  => 'manage_process_form_field.required_label',
            'note'   => 'manage_process_form_field.required_note',
            'value'  => '0'
        ]);

        $sectionOptions = \App::service('core.process')->getSectionOptions($stepId);
        $sectionValue = null;

        if (!empty($sectionOptions)) {
            $sectionValue = $sectionOptions[0]['value'];
        }

        $this->addElement([
            'plugin'   => 'radio',
            'name'     => 'section_id',
            'label'    => 'manage_process_form_field.section_label',
            'note'     => 'manage_process_form_field.section_note',
            'required' => true,
            'value'    => $sectionValue,
            'options'  => $sectionOptions,
        ]);


        $this->addElement([
            'plugin'        => 'radio',
            'name'          => 'plugin_id',
            'label'         => 'manage_process_form_field.plugin_label',
            'note'          => 'manage_process_form_field.plugin_note',
            'required'      => true,
            'value'         => 'text',
            'optionTextKey' => 'core.form_plugin_opt_',
            'options'       => \App::service('core.process')->getPluginOptions(),
        ]);
    }

    /**
     * @return int
     */
    public function getStepId()
    {
        return $this->stepId;
    }

    /**
     * @param int $stepId
     */
    public function setStepId($stepId)
    {
        $this->stepId = $stepId;
    }

}