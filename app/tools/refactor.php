<?php

$startpath  = dirname(dirname(__FILE__)) . '/bundle/kendo/src';

$ritit = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($startpath), RecursiveIteratorIterator::CHILD_FIRST);
$r = array();

$reg = "#@([namespace|return|var|params]+)\s+\\User#m";

$base  = [
    'Blog',
    'Comment',
    'Event',
    'Feed',
    'Follow',
    'Group',
    'Help',
    'Like',
    'Message',
    'Page',
    'Place',
    'Rad',
    'Report',
    'Review',
    'Share',
    'Social',
    'Video',
];

$platform  =  [
    'Acl',
    'Captcha',
    'Catalog',
    'Core',
    'Invitation',
    'Layout',
    'Link',
    'Mail',
    'Navigation',
    'Notification',
    'Payment',
    'Photo',
    'Phrase',
    'Relation',
    'Search',
    'Setting',
    'Storage',
    'Subscription',
    'Tag',
    'User',
];



foreach ($ritit as $splFileInfo) {

    if($splFileInfo->isDir()) continue;

    $path = $splFileInfo->getPathName();

    $content  =  file_get_contents($path);

    foreach($platform as $moduleName)
    {


        $content  =  str_replace("use \\Platform\\".$moduleName ."\\Form", 'use Platform\\'.$moduleName.'\\Form\\', $content);
    }

    file_put_contents($path, $content);
}