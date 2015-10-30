<?php
namespace Core\Service;

use Core\Model\Process;
use Core\Model\ProcessField;
use Core\Model\ProcessSection;
use Core\Model\ProcessStep;
use Picaso\Html\FormStep;

/**
 * Class ProcessService
 *
 * @package Core\Service
 */
class ProcessService
{

    /**
     * @return array
     */
    public function getPluginOptions()
    {
        $options = [];

        $rows = \App::table('core.process_plugin')
            ->select()
            ->all();

        foreach ($rows as $row) {
            $options[] = ['value' => $row->getId()];
        }

        return $options;
    }

    /**
     * @param string $contentType
     * @param string $actionType
     *
     * @return array
     */
    public function getStepSection($contentType, $actionType = 'edit')
    {
        $options = [];

        $rows = \App::table('core.process_step')
            ->select()
            ->where('content_type=?', (string)$contentType)
            ->where('action_type=?', (string)$actionType)
            ->all();

        foreach ($rows as $row) {
            $options[] = ['value' => $row->getId()];
        }

        return $options;
    }

    /**
     * @param string $stepId
     *
     * @return array
     */
    public function getSectionOptions($stepId)
    {
        $options = [];

        $rows = \App::table('core.process_section')
            ->select()
            ->where('step_id=?', (string)$stepId)
            ->all();

        foreach ($rows as $row) {
            $options[] = [
                'value' => $row->getId(),
                'label' => \App::text($row->getTitle()),
            ];
        }

        return $options;
    }

    /**
     * @param string $contentType
     * @param string $actionType
     *
     * @return array
     *
     */
    public function getUniqueSteps($contentType, $actionType = 'edit')
    {
        $rows = \App::table('core.process_step')
            ->select()
            ->where('content_type=?', (string)$contentType)
            ->where('action_type=?', (string)$actionType)
            ->order('step_number, sort_order', 1)
            ->all();

        $response = [];

        foreach ($rows as $row) {
            if (empty($response[ $row->getId() ])) {
                $response[ $row->getId() ] = $row;
            }
        }

        return $response;
    }

    /**
     * @param string $contentType
     * @param string $actionType
     *
     * @return array
     */
    public function getStepOptions($contentType, $actionType = 'edit')
    {
        $options = [];

        $rows = \App::table('core.process_step')
            ->select()
            ->where('content_type=?', (string)$contentType)
            ->where('action_type=?', (string)$actionType)
            ->all();

        foreach ($rows as $row) {
            $options[] = [
                'value' => $row->getId(),
                'label' => \App::text($row->getTitle()),
            ];
        }

        return $options;
    }

    /**
     * @param string $type
     *
     * @return array
     */
    public function getRuleOptions($type)
    {
        $options = [];

        $rows = \App::table('core.process_rule')
            ->select()
            ->where('plugin_allows like ?', "%<$type>%")
            ->all();

        foreach ($rows as $row) {
            $options[] = [
                'value' => $row->getId(),
                'label' => $row->getTitle(),
                'note'  => $row->getDescription(),
            ];
        }

        return $options;
    }

    /**
     * @param string $contentType
     * @param string $actionType
     *
     * @return \Core\Model\Process
     */
    public function findProcess($contentType, $actionType)
    {
        return \App::table('core.process')
            ->select()
            ->where('content_type=?', $contentType)
            ->where('action_type=?', $actionType)
            ->one();

    }

    /**
     * @param int $stepId
     *
     * @return ProcessStep
     */
    public function findStep($stepId)
    {
        return \App::table('core.process_step')
            ->findById((int)$stepId);

    }

    /**
     * @param int $sectionId
     *
     * @return \Core\Model\ProcessSection
     */
    public function findSection($sectionId)
    {
        return \App::table('core.process_section')
            ->findById((int)$sectionId);
    }

    /**
     * @param  int $fieldId
     *
     * @return \Core\Model\ProcessField
     */
    public function findField($fieldId)
    {
        return \App::table('core.process_field')
            ->findById((int)$fieldId);
    }


    /**
     * @param string $ruleId
     *
     * @return \Core\Model\ProcessRule
     */
    public function findRule($ruleId)
    {
        return \App::table('core.process_rule')
            ->findById((string)$ruleId);
    }


    /**
     * Ge first step data for render ecollating.
     *
     * @param string $contentType
     * @param string $actionType
     * @param int    $stepNumber = 0
     *
     * @return \Picaso\Html\FormStep
     * @throws \InvalidArgumentException
     */
    public function getProcessForm($contentType, $actionType, $stepNumber = 0)
    {
        $process = $this->findProcess($contentType, $actionType);

        if (!$process instanceof Process) {
            throw new \InvalidArgumentException("Could not find process [$contentType]");
        }

        $steps = $process->getSteps($stepNumber);

        /**
         * Get process data
         *
         * @var array
         */
        $data = $this->getProcessData($contentType);

        $matchedStep = null;

        foreach ($steps as $step) {
            if (!$step instanceof ProcessStep) {
                continue;
            }

            $conditions = $step->getConditions();

            if (empty($conditions)) {
                $matchedStep = $step;
                break;
            }

            if ($this->testCondition($data, $conditions)) {
                $matchedStep = $step;
                continue;
            }
        }

        if (null == $matchedStep) {
            return null;
        }

        return $this->createFromFromStep($matchedStep->getId());
    }

    /**
     * @param string $key
     *
     * @return array
     */
    public function getProcessData($key)
    {
        if (!empty($_SESSION[ $key ])) {
            return (array)$_SESSION[ $key ];
        }

        return [];
    }

    /**
     * @param string $key
     * @param array  $data
     *
     */
    public function setProcessData($key, $data)
    {
        $_SESSION[ $key ] = $data;
    }

    /**
     * @param $key
     */
    public function clearProcessData($key)
    {
        unset($_SESSION[ $key ]);
    }

    /**
     * @param $data
     * @param $conditions
     *
     * @return bool
     */
    public function testCondition($data, $conditions)
    {
        /**
         *
         */
        foreach ($conditions as $key => $spec) {
            list($key, $comparator, $param) = $spec;

            $actual = isset($data[ $key ]) ? $data[ $key ] : null;

            if (!\App::comparator()->test($comparator, $actual, $param)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $stepId
     *
     * @return \Picaso\Html\Form
     */
    public function createFromFromStep($stepId)
    {
        $step = $this->findStep($stepId);


        if (!$step instanceof ProcessStep) {
            throw new \InvalidArgumentException("Invalid process step id [$stepId]");
        }

        /**
         * now create step from in this case
         */
        if ($step->isCustom() && $step->getCustomForm()) {
            return \App::html()->factory($step->getCustomForm(), [
                'contentType' => $step->getProcessId(),
                'actionType'  => $step->getStepNumber(),
                'title'       => $step->getTitle(),
                'note'        => $step->getDescription(),

            ]);
        }

        $elements = [];
        /**
         *
         */
        foreach ($step->getSections(true) as $section) {

            if (!$section instanceof ProcessSection) {
                continue;
            }

            if ($section->isRequired()) {
                $elements[] = [
                    'plugin' => 'section',
                    'label'  => $section->getTitle(),
                    'note'   => $section->getDescription(),
                ];
            }

            foreach ($section->getFields(true) as $field) {

                if (!$field instanceof ProcessField) {
                    continue;
                }

                $name = $field->getFieldName();

                $props = $field->getProps();

                $elements[ $name ] = [
                    'plugin'      => $field->getPluginId(),
                    'name'        => $field->getFieldName(),
                    'required'    => $field->isRequired(),
                    'label'       => !empty($props['show_title']) ? $field->getTitle() : null,
                    'note'        => !empty($props['show_note']) ? $field->getDescription() : null,
                    'class'       => !empty($props['class']) ? $props['class'] : null,
                    'placeholder' => !empty($props['show_placeholder']) ? $field->getTitle() : null,
                    'rules'       => $field->getRules(),
                ];
            }
        }

        $form = new FormStep([
            'contentType' => $step->getContentType(),
            'actionType'  => $step->getActionType(),
            'stepNumber'  => $step->getStepNumber(),
            'title'       => $step->getTitle(),
            'note'        => $step->getDescription(),
        ]);

        $form->addElements($elements);

        return $form;
    }

    /**
     * @param string $contentType
     *
     * @return array
     */
    public function getProfileFields($contentType)
    {
        $dataType = \App::table('core.process_data_type');

        $fields = \App::table('core.profile_field')
            ->select('pt')
            ->where('content_type=?', $contentType)
            ->join($dataType->getName(), 'dt', 'dt.data_type=pt.data_type', null, null)
            ->toAssocs();

        $response = [];

        foreach ($fields as $field) {
            $response[ $field['field_name'] ] = $field;
        }

        return $response;
    }

    /**
     * @param string $contentType
     * @param string $actionType
     * @param int    $stepNumber
     *
     * @return array {fields: array of field names, sections: list of sections}
     */
    public function getAboutFieldStructure($contentType, $actionType = 'about', $stepNumber = 0)
    {

        $step = \App::table('core.process_step')
            ->select()
            ->where('content_type=?', $contentType)
            ->where('action_type=?', $actionType)
            ->where('step_number=?', $stepNumber)
            ->one();

        if (!$step instanceof ProcessStep) {
            throw new \InvalidArgumentException("Could not find step");
        }


        $profileFields = $this->getProfileFields($contentType);

        /**
         * load all field structure from this data.
         */

        $sectionList = [];
        $fieldNames = [];

        /**
         * @return array
         */
        foreach ($step->getSections(true) as $section) {
            if (!$section instanceof ProcessSection) {
                continue;
            }

            $sectionName = $section->getName();

            $sectionData = [
                'name'        => $sectionName,
                'id'          => $section->getId(),
                'label'       => $section->getTitle(),
                'description' => $section->getDescription(),
                'fields'      => [],
            ];

            foreach ($section->getFields(true) as $field) {
                if (!$field instanceof ProcessField) {
                    continue;
                }

                $fieldNames[] = $fieldName = $field->getName();

                $fieldData = [
                    'label' => $field->getTitle(),
                    'multi' => $profileFields[ $fieldName ]['is_multiple'] ? 1 : 0,
                ];

                $sectionData['fields'][ $fieldName ] = $fieldData;
            }

            $sectionList[ $sectionName ] = $sectionData;
        }

        return [
            'fields'   => $fieldNames,
            'sections' => $sectionList,
        ];
    }
}