<?php

namespace Attribute\Controller\Admin\Ajax;

use Picaso\Controller\AjaxController;

class ManageController extends AjaxController
{
    /**
     *
     */
    public function actionAddSection()
    {
        $catalogId = $this->request->getParam('catalogId');
        $sectionId = $this->request->getParam('id');
        $attribute = \App::attribute();
        $catalog = $attribute->findCatalogById($catalogId);
        $section = $attribute->findSectionById($sectionId);


        if (!$catalog or !$section or $catalog->getContentId() != $section->getContentId())
            throw new \InvalidArgumentException("Invalid params");

        $attribute->addSectionMap($catalogId, $sectionId);

        $this->response = [
            'success' => 'Changes saved',
        ];
    }

    /**
     *
     */
    public function actionRemoveSection()
    {
        $catalogId = $this->request->getParam('catalogId');
        $sectionId = $this->request->getParam('id');
        $attribute = \App::attribute();

        $attribute->removeSectionMap($catalogId, $sectionId);

        $this->response = [
            'success' => 'Changes saved',
        ];
    }
}