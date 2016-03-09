<?php
include '../init.php';

$db = app()->db()->getMaster();
$generator = new Kendo\CodeGenerator\DbTable();

foreach ($db->tables() as $table) {
    $generator->generate($table);
}