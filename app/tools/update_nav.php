<?php

include '../init.php';


$select = app()->table('platform_navigation_item')
    ->select()
    ->where('route=?', 'admin')
    ->all();

foreach ($select as $item) {

    if (null == $item->params_text)
        continue;

    $params = json_decode($item->params_text, true);

    if (empty($params['stuff']))
        continue;

    $any = $params['stuff'];

    unset($params['stuff']);

    $params['any'] = 'platform/' . $any;

    $item->params_text = json_encode($params);
    $item->save();

    var_export($params);
}

