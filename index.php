<?php

ob_start();

if(false == file_exists('app/config/database.conf.php')){
    exit('Access "/install" to start installation');
}

include 'app/init.php';

\App::session();

$view = new \Picaso\View\View();
$request = App::request()->getInitiator();

defined('IS_AJAX_LOAD_STATE') or define('IS_AJAX_LOAD_STATE', $request->getParam('__ajax_load_page') ? 1 : 0);

$request->execute();

try {
    if (IS_AJAX_LOAD_STATE) {
        $json = json_encode([
            'directive' => 'update',
            'title'     => \App::assets()->title()->toText(),
            'html'      => App::layout()->render('/layout/master/site-ow')
        ]);
        echo '<script type="text/javascript">window.parent.onFetchPageComplete(' . $json . ')</script>';
    } else
        if ($request->isAjax()) {
            echo $request->getResponse();
        } else {
            echo App::layout()->render();
        }
} catch (Exception $e) {
    throw $e;
}