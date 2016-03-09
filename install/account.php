<?php

$form = new \Installation\Form\SetupAccount();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $form->isValid($_POST)) {
    $data = $form->getData();

    $handler = new \Installation\Service\InstallationService();

    $handler->createSuperAdminAccount($data);

    app()->cacheService()
        ->flush();

    header('location:?_step=complete');
    exit;
}

include 'views/form.tpl';