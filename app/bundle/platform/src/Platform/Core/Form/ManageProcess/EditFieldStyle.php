<?php
namespace Platform\Core\Form\ManageProcess;

use Kendo\Html\Form;

/**
 * Class EditFieldStyle
 *
 * @package Core\Form\ManageProcess
 */
class EditFieldStyle extends Form
{

    /**
     * @var string
     */
    protected $pluginId;

    /**
     * @return string
     */
    public function getPluginId()
    {
        return $this->pluginId;
    }

    /**
     * @param string $pluginId
     */
    public function setPluginId($pluginId)
    {
        $this->pluginId = $pluginId;
    }

    /**
     *
     */
    protected function init()
    {
        $this->setTitle('form_process_style.form_title');
        $this->setNote('form_process_style.form_note');

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'show_title',
            'label'  => 'form_process_style.show_title_label',
            'note'   => 'form_process_style.show_title_note',
            'value'  => '1',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'show_note',
            'label'  => 'form_process_style.show_note_label',
            'note'   => 'form_process_style.show_note_note',
            'value'  => '0',
        ]);

        $this->addElement([
            'plugin' => 'yesno',
            'name'   => 'show_placeholder',
            'label'  => 'form_process_style.show_placeholder_label',
            'note'   => 'form_process_style.show_placeholder_note',
            'value'  => '1',
        ]);

        $this->addElement([
            'plugin'   => 'text',
            'name'     => 'class',
            'label'    => 'form_process_style.prop_class_label',
            'note'     => 'form_process_style.prop_class_note',
            'value'    => '',
            'required' => false,
        ]);

    }


}