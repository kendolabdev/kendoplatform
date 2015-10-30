<?php

$errorMsg = '';

$form = new \Installation\Form\SetupDatabase();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $form->isValid($_POST)) {

    $data = $form->getData();

    // setup database locator
    $config = [
        'prefix'  => $data['prefix'],
        'default' => [
            'replicate' => false,
            'driver'    => 'mysqli',
            'charset'   => 'UTF8',
            'database'  => $data['database'],
            'user'      => $data['usr_name'],
            'password'  => $data['usr_pwd'],
            'master'    => [
                [
                    'host'   => $data['host'],
                    'port'   => $data['port'],
                    'socket' => null,
                ],
            ],
        ],
    ];

    try {

        if (!is_writable(PICASO_CONFIG_DIR))
            throw new \RuntimeException(sprintf('Directory %s is now writable', PICASO_CONFIG_DIR));

        \App::db()
            ->setConfig($config);

        $master = \App::db()
            ->getMaster();

        $importer = new \Installation\Service\InstallationService();

        $importer->import();

        // write down config

        $importer->updateDatabaseConfiguration($config);

        // import database from the cash

        \App::cache()
            ->flush();

        //final
        header('location:?_step=account');
        exit;

    } catch (Exception $ex) {
        $errorMsg = $ex->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

}

include 'views/form.tpl';
