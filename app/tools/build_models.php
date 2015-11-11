<?php
include '../init.php';

$db = \App::db()->getMaster();
$generator = new Picaso\CodeGenerator\DbTable();

foreach ($db->tables() as $table) {
    $generator->generate($table);
}