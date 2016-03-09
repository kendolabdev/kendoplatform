<?php

define('KENDO_UNITEST', true);

include '/Users/namnv/Sites/younetco.com/kendoplatform/app/init.php';

app()->instance()->setUnitest(true);
app()->instance()->setDebug(true);
