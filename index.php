<?php

require 'vendor/slim/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

require('vendor/smarty/smarty/libs/Smarty.class.php');
$GLOBALS['smarty'] = new Smarty();
$smarty->setCacheDir('views/cache');
$smarty->setConfigDir('views/configs');
$smarty->setTemplateDir('views/templates');
$smarty->setCompileDir('views/templates_c');

// Set the current mode
$app = new \Slim\Slim(array(
    'mode' => 'development'
));

// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});
// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'debug' => true
    ));
});

//autoload controller
function loadController($file_name){
    include_once('controller/'.$file_name.'.php');
}

/* 
    Routes
*/

$app->get('/', function () {
    loadController("main");
});


header("Access-Control-Allow-Origin: *");
$app->run();
?>