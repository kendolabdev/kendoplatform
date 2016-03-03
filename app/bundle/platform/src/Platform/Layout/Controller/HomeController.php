<?php
namespace Platform\Layout\Controller;

use Kendo\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Platform\Layout\Controller
 */
class HomeController extends DefaultController
{
    /**
     * Select theme to add default.
     */
    public function actionSelectTheme()
    {
        if ($this->request->isMethod('post')&& !empty($_POST['theme_id'])) {
            @setcookie('themeId', $_POST['theme_id'], time() + 365 * 86400, '/');
            \App::routing()->redirect('home');
        }

        $paging = \App::table('platform_layout_theme')
            ->select()
            ->where('is_active=?', 1)
            ->paging(1, 100);

        $this->view
            ->setScript('platform/layout/controller/home/select-theme/view')
            ->assign(['paging' => $paging]);
    }
}