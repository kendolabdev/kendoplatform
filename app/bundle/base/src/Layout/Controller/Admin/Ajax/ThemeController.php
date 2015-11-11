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
        $id = $this->request->getParam('id', 'default');

        try {
            \App::layout()
                ->theme()
                ->rebuildStylesheetForTheme($id);
            $this->response = [
                'directive' => 'reload',
                'success'   => 'Rebuild theme ' . $id
            ];
        } catch (\Exception $e) {
            $this->response = [
                'directive' => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }

    public function actionExport()
    {
        $id = $this->request->getParam('id', 'default');

        try {
            \App::layout()
                ->theme()
                ->export($id);

            $this->response = [
                'directive' => 'reload',
                'success'   => 'Exported theme ' . $id
            ];
        } catch (\Exception $e) {
            $this->response = [
                'directive' => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }
}