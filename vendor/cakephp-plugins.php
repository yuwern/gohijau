<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Acl' => $baseDir . '/vendor/abreu1234/acl/',
        'AkkaCKEditor' => $baseDir . '/vendor/akkaweb/cakephp-ckeditor/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'Bootstrap' => $baseDir . '/vendor/holt59/cakephp3-bootstrap-helpers/',
        'CakePdf' => $baseDir . '/vendor/friendsofcake/cakepdf/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Josegonzalez/Upload' => $baseDir . '/vendor/josegonzalez/cakephp-upload/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Search' => $baseDir . '/vendor/friendsofcake/search/'
    ]
];
