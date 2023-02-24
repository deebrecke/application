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

        //create object but don't put data inside it yet
        $newApplicant = new Applicant();

        //validate name--both invalid first and last names go into "name" error
        $fname = trim($_POST['fname']);
        if(Validate::validName($fname)){
            $newApplicant->setFName($fname);
        }
        else{
            $f3->set('errors["name"]',
            'Please enter only alpha chars');
        }

        $lname = trim($_POST['lname']);
        if(Validate::validName($lname)){
            $newApplicant->setLName($lname);
        }
        else{
            $f3->set('errors["name"]',
                'Please enter only alpha chars');
        }

        //validate email
        $email=trim($_POST['email']);
        if(Validate::validEmail($email)){
            $newApplicant->setEmail($email);
        }
        else{
            $f3->set('errors["email"]',
                'Please enter a valid email address');
        }

        $state = $_POST['state'];
        $newApplicant->setState($state);

        //validate phone number
        $phone=$_POST['phone'];
        if(Validate::validPhone($phone)){
            $newApplicant->setPhone($phone);
        }
        else{
            $f3->set('errors["phone"]',
                'Please enter a valid phone number');
        }

        //only reroute if valid (sticky)
        if (empty($f3->get('errors'))) {
            $_SESSION['newApplicant']=$newApplicant;
            $f3->reroute('apply2');
        }
    }
    //first rendering of the page
    $f3->set('states', DataLayer::getStates());
    $view = new Template();
    echo $view->render('views/personal-info.html');
});

//experience page
$f3->route('GET|POST /apply2', function ($f3){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SESSION['bio'] = $_POST['bio'];
        $_SESSION['rchoice'] = $_POST['rchoice'];

        $github = $_POST['github'];
        if(Validate::validGithub($github)){
            $_SESSION['github'] = $github;
        }
        else{
            $f3->set('errors["github"]',
            'Please enter a valid url');
        }

        //Validate the experience
        $yrs = $_POST['yrs'];
        if (Validate::validExperience($yrs)) {
            $_SESSION['yrs'] = $yrs;
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
    }

    //Add radio button arrays from data-layer to F3 hive
    $f3->set('experience', DataLayer::getExperience());
    $f3->set('relo', DataLayer::getRelo());

    $view = new Template();
    echo $view->render('views/experience.html');
});

//TODO: get back to this later, because if they want to be on the mailing list
//they are a different type of object (child)
//This is beyond the scope of what we have learned so far

//job openings page
$f3->route('GET|POST /apply3', function ($f3){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $jchoice = $_POST['jchoice'];
        //check to see if any boxes have been selected
        if(isset($jchoice)){
            //if so, run validation
            if(Validate::validSelectionsJobs($jchoice)){
                $_SESSION['jchoice'] = implode(", ", $jchoice);
            }
            else{
                $f3->set('errors["job"]',
                    'Job selection is invalid');
            }
        }else{//make sure to update the session variable
            $_SESSION['jchoice'] = $jchoice;
        }

        $vchoice = $_POST['vchoice'];
        if(isset($vchoice)){
            if(Validate::validSelectionsVerticals($vchoice)){
               $_SESSION['vchoice'] = implode(", ", $vchoice);
            }
            else{
                $f3->set('errors["vertical"]',
                    'Vertical selection is invalid');
            }
        }else{
            $_SESSION['vchoice'] = $vchoice;
        }

        if (empty($f3->get('errors'))) {
            $f3->reroute('summary');
        }
    }

    //add checkboxes to f3 hive
    $f3->set('jobs', DataLayer::getJobs());
    $f3->set('verticals', DataLayer::getVerticals());
    $view = new Template();
    echo $view->render('views/job-openings.html');
});

$f3->route('GET|POST /summary', function(){
    $view = new Template();
    echo $view->render('views/summary-page.html');
    session_destroy();
});
//Run fat free
$f3->run();
?>
