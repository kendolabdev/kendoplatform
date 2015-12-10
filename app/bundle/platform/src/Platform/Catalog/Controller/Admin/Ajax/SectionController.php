<?php

namespace Platform\Catalog\Controller\Admin\Ajax;

use Kendo\Controller\AjaxController;

/**
 * Class SectionController
 *
 * @package Attribute\Controller\Admin\Ajax
 */
class SectionController extends AjaxController
{
    /**
     *
     */
    public function actionAddField()
    {
        $sectionId = $this->request->getParam('sectionId');
        $fieldId = $this->request->getParam('id');
        $attribute = \App::catalogService();
        $section = $attribute->findSectionById($sectionId);
        $field = $attribute->findFieldById($fieldId);


        if (!$section)
            throw new \InvalidArgumentException("Invalid params [sectionId=$sectionId]");

        if (!$field)
            throw new \InvalidArgumentException("Invalid params [id]");

        if ($section->getContentId() != $field->getContentId())
            throw new \InvalidArgumentException("Invalid params");

        $attribute->addFieldMap($sectionId, $fieldId);

        $this->response = [
            'success' => 'Changes saved',
        ];
    }

    /**
     *
     */
    public function actionRemoveField()
    {
        $sectionId = $this->request->getParam('sectionId');
        $fieldId = $this->request->getParam('id');
        $attribute = \App::catalogService();

        $attribute->removeFieldMap($sectionId, $fieldId);

        $this->response = [
            'success' => 'Changes saved',
        ];
    }
}