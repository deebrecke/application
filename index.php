<?php
/*
Dee Brecke
1/15/23
328/application/index.php
This file defaults to the home page, turns on error reporting,
requires vendor/autoload and runs fat free. It handles all of the routing
for the form.
*/
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file before session starts
require_once("vendor/autoload.php");
//start the session AFTER
session_start();
//var_dump($_SESSION);
//require_once('model/data-layer.php');
//require_once('model/validate.php');

//$myApplicant = new Applicant();
//var_dump($myApplicant);
//$myApplicant->setFName("Dee");
//echo $myApplicant->getFName();

$myMailApp = new Applicant_SubscribedToList();
//var_dump($myMailApp);
//var_dump(getExperience()); this was written correctly

//Create an instance of the Base class
$f3 = Base::instance();

//Instantiate a controller object
$con = new Controller($f3);

//Define a default route ("home page" for application)
$f3->route('GET /', function(){
    $GLOBALS['con']->home();
});

//personal info page--GET loads the page, POST saves the info and reroutes
$f3->route('GET|POST /apply1', function ($f3){
    $GLOBALS['con']->apply1();
});

//experience page
$f3->route('GET|POST /apply2', function ($f3){
    $GLOBALS['con']->apply2();
});

//job openings page
$f3->route('GET|POST /apply3', function ($f3){
    $GLOBALS['con']->apply3();
});

$f3->route('GET|POST /summary', function(){
    $GLOBALS['con']->summary();
});
//Run fat free
$f3->run();

