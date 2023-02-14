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

session_start();

//Require the autoload file
require_once("vendor/autoload.php");
require_once('model/data-layer.php');
require_once('model/validate.php');

//var_dump(getExperience()); this was written correctly

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route ("home page" for application)
$f3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

//personal info page--GET loads the page, POST saves the info and reroutes
$f3->route('GET|POST /apply1', function ($f3){

    //do a var dump to check data
    // var_dump ($_POST);
   //once the form is filled out, add to session array
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = trim($_POST['name']);
        if(validName($name)){
            $_SESSION['name']= $name;
        }
        else{
            $f3->set('errors["name"]',
            'Please enter only alpha chars');
        }

        $email=trim($_POST['email']);
        if(validEmail($email)){
            $_SESSION['email'] = $email;
        }
        else{
            $f3->set('errors["email"]',
                'Please enter a valid email address');
        }



        $_SESSION['state'] = $_POST['state'];
        $_SESSION['phone'] = $_POST['phone'];

        if (empty($f3->get('errors'))) {
            $f3->reroute('apply2');
        }
    }
    //first rendering of the page
    $view = new Template();
    echo $view->render('views/personal-info.html');
});


$f3->route('GET|POST /apply2', function ($f3){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SESSION['bio'] = $_POST['bio'];

        $github = $_POST['github'];
        if(validGithub($github)){
            $_SESSION['github'] = $github;
        }
        else{
            $f3->set('errors["github"]',
            'Please enter a valid url');
        }

        //Validate the experience
        $yrs = $_POST['yrs'];
        if (validExperience($yrs)) {
            $_SESSION['experience'] = $yrs;
        }
        else {
            $f3->set('errors["yrs"]',
                'Experience is invalid');
        }

        //Redirect to the next page
        //if there are no errors
        if (empty($f3->get('errors'))) {
            $f3->reroute('apply3');
        }

        $_SESSION['relo'] = $_POST['relo'];

    }

    //Add experience to F3 hive
    $f3->set('experience', getExperience());

    $view = new Template();
    echo $view->render('views/experience.html');
});

$f3->route('GET|POST /summary', function(){
    $view = new Template();
    echo $view->render('views/summary-page.html');
});

$f3->route('GET|POST /apply3', function ($f3){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //add in the check-boxes here
        $job = $_POST['job'];
        if(validSelectionsJobs($job)){
            $_SESSION['job'] = $job;
        }
        else{
            $f3->set('errors["job"]',
            'Job selection is invalid');
        }


        if (empty($f3->get('errors'))) {
            $f3->reroute('summary');
        }

    }

    $f3->set('jobs', getJobs());
    $view = new Template();
    echo $view->render('views/job-openings.html');
});
//Run fat free
$f3->run();
?>
