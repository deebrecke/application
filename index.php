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

//personal info page--GET loads the page, POST saves the info and reroutes
$f3->route('GET|POST /apply1', function ($f3){
    //once the form is filled out, add to session array
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['fName'] = $_POST['fName'];
        $_SESSION['lName'] = $_POST['lName'];
        $_SESSION['email'] = $_POST['email'];
        //$_SESSION['state'] = $_POST['state'];
        //$_SESSION['phone'] = $_POST['phone'];

        //this needs to reroute to experience page once I can get it all to work
        $f3->reroute('summary');
    }
    //first rendering of the page
    $view = new Template();
    echo $view->render('views/personal-info.html');
});

//personal info page--GET loads the page, POST saves the info and reroutes
$f3->route('GET|POST /apply2', function (){
//    //once the form is filled out, add to session array
//    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//        $_SESSION['fName'] = $_POST['fName'];
//        $_SESSION['lName'] = $_POST['lName'];
//        $_SESSION['email'] = $_POST['email'];
//        //this needs to reroute to job openings page once I can get it all to work
//        $f3->reroute('summary');
//    }
//    //first rendering of the page
    $view = new Template();
    echo $view->render('views/summary-page.html');
});

$f3->route('GET|POST /summary', function(){
    $view = new Template();
    echo $view->render('views/summary-page.html');
});

$f3->route('POST /apply3', function (){
    $view = new Template();
    echo $view->render('views/summary-page.html');
});
//Run fat free
$f3->run();
?>
