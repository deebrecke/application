<?php
/*
Dee Brecke
1/15/23
This file defaults to the home page, turns on error reporting,
requires vendor/autoload and runs fat free
*/
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//Require the autoload file
require_once("vendor/autoload.php");

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route ("home page" for application)
$f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET /apply1', function (){
    $view = new Template();
    echo $view->render('views/personal-info.html');
});

$f3->route('POST /apply2', function (){
    $view = new Template();
    echo $view->render('views/experience.html');
});


//Run fat free
$f3->run();
?>
