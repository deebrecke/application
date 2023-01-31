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

$f3->route('GET|POST /summary', function(){
    $view = new Template();
    echo $view->render('views/summary-page.html');
});

$f3->route('GET|POST /apply2', function ($f3){
    //var_dump($_POST);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['fName'] = $_POST['fName'];
        $_SESSION['lName'] = $_POST['lName'];

        $f3->reroute('summary');
    }
    //$view = new Template();
    //echo $view->render('views/summary-page.html');

});


$f3->route('POST /apply3', function (){
    $view = new Template();
    echo $view->render('views/summary-page.html');
});
//Run fat free
$f3->run();
?>
