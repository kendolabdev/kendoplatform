<?php
namespace Layout\Controller\Admin\Ajax;

use Picaso\Controller\AjaxController;

/**
 * Class ThemeController
 *
 * @package Layout\Controller\Admin\Ajax
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
            $ext = \App::core()
                ->extension()
                ->findExensionById($id);

            if (!$ext->isTheme())
                throw new \InvalidArgumentException("Invalid theme id");

            $theme = \App::layout()
                ->theme()
                ->findThemeByExtensionName($ext->getName());

            if (!$theme) {
                $ext->delete();
                throw new \InvalidArgumentException("Invalid theme");
            }


            \App::layout()
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