<?php
namespace Platform\Core\Form\ManageProcess;

use Kendo\Html\Form;

/**
 * Class AddSection
 *
 * @package Core\Form\ManageProcess
 */
class AddSection extends Form
{

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var string
     */
    protected $actionType;

    /**
     *
     */
    protected function init()
    {
        parent::init();

        $this->setTitle('manage_process_form_section.form_add_title');

        $this->setNote('manage_process_form_section.form_add_note');

        $this->addElement([
            'plugin'    => 'text',
            'name'      => 'section_name',
            'label'     => 'manage_process_form_section.section_name_label',
            'note'      => 'manage_process_form_section.section_name_note',
            'required'  => true,
            'maxlength' => 20,
        ]);

        $this->addElement([
            'plugin'   => 'radio',
            'name'     => 'step_id',
            'label'    => 'manage_process_form_section.step_label',
            'note'     => 'manage_process_form_section.step_note',
            'required' => true,
            'options'  => app()->instance()->make('platform_core_process')->getStepOptions($this->getContentType(), $this->getActionType()),
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_active',
            'label'  => 'manage_process_form_section.active_label',
            'note'   => 'manage_process_form_section.active_note',
            'value'  => '1'
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'is_required',
            'label'  => 'manage_process_form_section.required_label',
            'note'   => 'manage_process_form_section.required_note',
            'value'  => '0'
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'sort_order',
            'label'    => 'manage_process_form_section.section_sort_order_label',
            'note'     => 'manage_process_form_section.section_sort_order_note',
            'value'    => '0',
            'required' => true,
        ]);
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return string
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * @param string $actionType
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;
    }

}