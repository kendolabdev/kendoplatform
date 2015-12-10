<?php

defined('are_you_sure') or die('are you sure?');

$database_host = 'localhost'; // Database hostname
$database_user = 'root'; // Database username
$database_password = 'namnv123'; // Database password
$database_name = 'picaso'; // Database name

$platforms  = [
    'core',
    'acl',
    'relation',
    'layout',
    'user',
    'photo',
    'setting',
    'storage',
    'link',
    'mail',
    'invitation',
    'notification',
    'tag',
    'phrase',
    'payment',
    'navigation',
];

$bases= [
    'blog',
    'page',
    'group',
    'event',
    'feed',
    'comment',
    'like',
    'share',
    'review',
    'video',
    'report',
    'help',
    'follow',
    'message',
    'rad',
    'share',
    'social',
    'place'
];

$new_table_prefix = 'picaso_platform_core_'; // New table prefix
$old_table_prefix = 'picaso_core_'; // Old table prefix (optional)
$test = false; // Test-run (true or false)

// NO NEED TO EDIT BELOW THIS LINE

// Login to the database server
$db = mysql_connect($database_host, $database_user, $database_password) or die('MySQL connect failed');

// Connect to the database
mysql_select_db($database_name) or die('Failed to select database');

// Get a listing of all tables
$query = "SHOW TABLES";
$result = mysql_query($query) or die('SHOW TABLES failed');

// Loop through all tables
while($row = mysql_fetch_array($result)) {

    $testName =  $row[0];

    $testArray = explode('_', $testName);

    if($testArray[0] !== 'picaso') continue;
    if(in_array($testArray[1], $platforms)){
        $old_table_prefix = 'picaso_'. $testArray[1] . '';
        $new_table_prefix = 'picaso_platform_'. $testArray[1] .'';
    }else if(in_array($testArray[1], $bases)){
        $old_table_prefix = 'picaso_'. $testArray[1] . '';
        $new_table_prefix = 'picaso_base_'. $testArray[1] .'';
    }else{
        continue;
    }

    $old_table = $row[0];

    // Preliminary check: Is the old table prefix correct?
    if(!empty($old_table_prefix) && !preg_match('/^'.$old_table_prefix.'/', $old_table)) {
        echo "1.Table $old_table does not match prefix $old_table_prefix\n";
        continue;
    }

    // Preliminary check: Is the old table prefix the same as the new one?
    if(preg_match('/^'.$new_table_prefix.'/', $old_table)) {
        echo "2.Table $old_table already done\n";
        continue;
    }

    // Construct the new table prefix
    if(!empty($old_table_prefix)) {
        $new_table = preg_replace('/^'.$old_table_prefix.'/', $new_table_prefix, $old_table);
    } else {
        $new_table = $new_table_prefix.$old_table;
    }

    // Rename the actual table
    echo "Renaming $old_table to $new_table\n";
    $query = "RENAME TABLE `$old_table`  TO `$new_table`";
    mysql_query($query);
}