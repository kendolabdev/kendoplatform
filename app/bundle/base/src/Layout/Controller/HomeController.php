<?php
namespace Layout\Controller;

use Picaso\Controller\DefaultController;

/**
 * Class HomeController
 *
 * @package Layout\Controller
 */
class HomeController extends DefaultController
{
    /**
     * Select theme to add default.
     */
    public function actionSelectTheme()
    {
        if ($this->request->isPost() && !empty($_POST['theme_id'])) {
            @setcookie('themeId', $_POST['theme_id'], time() + 365 * 86400, '/');
            \App::routingService()->redirect('home');
        }

        $paging = \App::table('layout.layout_theme')
            ->select()
            ->where('is_active=?', 1)
            ->paging(1, 100);

        $this->view
            ->setScript('base/layout/controller/home/select-theme/view')
            ->assign(['paging' => $paging]);
    }
}