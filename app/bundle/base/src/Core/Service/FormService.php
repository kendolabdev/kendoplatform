<?php

namespace Core\Service;

/**
 * Class FormService
 *
 * @package Core\Service
 */
class FormService
{
    /**
     * @param $stepNumber
     *
     * @return array
     */
    public function getFirstStep($stepNumber = 0)
    {

    }


    /**
     * @param string $formId
     *
     * @return array
     */
    public function getStepOptions($formId)
    {

        $rows = \App::table('core.form_step')
            ->select()
            ->where('form_id=?', $formId)
            ->all();

        $options = [];

        foreach ($rows as $row) {
            $options[] = ['value' => $row->__get('step_id'), 'label' => $row->__get('step_name')];
        }

        return $options;
    }

    /**
     * @param string $formId
     *
     * @return array
     */
    public function getSectionOptions($formId)
    {
        $rows = \App::table('core.form_section')
            ->select()
            ->where('form_id=?', $formId)
            ->all();

        $options = [];

        foreach ($rows as $row) {
            $options[] = ['value' => $row->__get('section_id'), 'label' => $row->__get('section_name')];
        }

        return $options;
    }
}