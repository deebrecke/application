<?php
/**
 * Home page with routing to prevent anyone directly accessing pages in wrong order
 *
 * Dee Brecke
 * 1/15/23
 * 328/application/index.php
 * This file defaults to the home page, turns on error reporting,
 * requires vendor/autoload and runs fat free. It handles all of the routing
 * for the form.
 * 3/3/2023 Now the controller is in a class of its own. This file still handles
 * the routing, but now it does so by passing controller objects to the routes
 */

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file before session starts
require_once "vendor/autoload.php";
//start the session AFTER
session_start();

//require ('/home/deedeegr/config.php');


//$testApplicant = new Applicant('test', 'person', 'me@email.com', '123456789');
//$id = $dataLayer->insertApplicant($testApplicant);
//echo "$id inserted succesfully!";

//Create an instance of the Base class
$f3 = Base::instance();

//Instantiate a controller and data layer object
$con = new Controller($f3);
$dataLayer = new DataLayer();

//Define a default route ("home page" for application)
$f3->route('GET /', function()
{
    $GLOBALS['con']->home();
});

//personal info page--GET loads the page, POST saves the info and reroutes
$f3->route('GET|POST /apply1', function ($f3)
{
    $GLOBALS['con']->apply1();
});

//experience page
$f3->route('GET|POST /apply2', function ($f3)
{
    $GLOBALS['con']->apply2();
});

//job openings page
$f3->route('GET|POST /apply3', function ($f3)
{
    $GLOBALS['con']->apply3();
});

$f3->route('GET|POST /summary', function()
{
    $GLOBALS['con']->summary();
});

$f3->route('GET|POST /adminPage', function()
{
    $GLOBALS['con']->adminPage();
});
//Run fat free
$f3->run();

