<?php
namespace Platform\Layout\Controller\Admin\Ajax;

use Kendo\Controller\AjaxController;

/**
 * Class ThemeController
 *
 * @package Platform\Layout\Controller\Admin\Ajax
 */
class ThemeController extends AjaxController
{
    /**
     * Rebuild theme
     */
    public function actionRebuild()
    {
        $id = $this->request->getParam('id');

        try {
            $ext = app()->coreService()
                ->extension()
                ->findExensionById($id);

            if (!$ext->isTheme())
                throw new \InvalidArgumentException("Invalid theme id");

            $theme = app()->layouts()
                ->theme()
                ->findThemeByExtensionName($ext->getName());

            if (!$theme) {
                $ext->delete();
                throw new \InvalidArgumentException("Invalid theme");
            }


            app()->layouts()
                ->theme()
                ->rebuildStylesheetForTheme($theme->getId());


            $this->response = [
                'directive' => 'success',
                'message'   => 'Rebuild theme ' . $theme->getTitle(),
            ];
        } catch (\Exception $e) {
            $this->response = [
                'directive' => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }
}