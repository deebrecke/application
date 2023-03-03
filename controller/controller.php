<?php

/**
 * Controller Class
 *
 * Dee Brecke
 * 3/3/2023
 * 328/application/controller/controller.php
 * This class contains methods with all the conditional logic for routing
 * The controller object is passed into the routes on index.php
 */
class Controller
{
    private $_f3; //fat free object

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    //default route
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Personal information page method
     *
     * This method displays the basic personal information page, validates the
     * input and determines which type of Applicant object is created. It
     * routes ether type to the next page to collect additional information
     * @return void
     */
    function apply1()
    {
        //once the form is filled out, add to session array
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mail = $_POST['mailList'];
            if (isset($mail)){
                $newApplicant = new Applicant_SubscribedToList();
            //if isset, applicant is this type else applicant is other type
            } else {
                //create object but don't put data inside it yet
                $newApplicant = new Applicant("", "", "", "");
            }
                //validate name--both invalid first and last names go into "name" error
                $fname = trim($_POST['fname']);
                if (Validate::validName($fname)) {
                    $newApplicant->setFName($fname);
                } else {
                    $this->_f3->set('errors["name"]',
                        'Please enter only alpha chars');
                }

                $lname = trim($_POST['lname']);
                if (Validate::validName($lname)) {
                    $newApplicant->setLName($lname);
                } else {
                    $this->_f3->set('errors["name"]',
                        'Please enter only alpha chars');
                }

                //validate email
                $email=trim($_POST['email']);
                if (Validate::validEmail($email)) {
                    $newApplicant->setEmail($email);
                } else {
                    $this->_f3->set('errors["email"]',
                        'Please enter a valid email address');
                }

                $state = $_POST['state'];
                $newApplicant->setState($state);

                //validate phone number
                $phone=$_POST['phone'];
                if (Validate::validPhone($phone)) {
                    $newApplicant->setPhone($phone);
                } else {
                    $this->_f3->set('errors["phone"]',
                        'Please enter a valid phone number');
                }

            //only reroute if valid (sticky)
            if (empty($this->_f3->get('errors'))) {
                $_SESSION['newApplicant']=$newApplicant;
                $this->_f3->reroute('apply2');
            }
        }
        //first rendering of the page
        $this->_f3->set('states', DataLayer::getStates());
        $view = new Template();
        echo $view->render('views/personal-info.html');
    }

    /**
     * Experience page method
     *
     * This method displays the experience page where the applicant enters
     * more information including how many years experience they have. It validates
     * the github url and years experience. If theobject is a child (wants to be on mailing lists),
     * it routes them to the job-openings page, otherwise it routes them directly to the summary
     * @return void
     */
    function apply2()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $relocate = $_POST['relocate'];
            $_SESSION['newApplicant']->setRelocate($relocate);

            $bio = $_POST['bio'];
            $_SESSION['newApplicant']->setBio($bio);

            $github = $_POST['github'];
            if (Validate::validGithub($github)) {
                $_SESSION['newApplicant']->setGithub($github);
            } else {
                $this->_f3->set('errors["github"]',
                    'Please enter a valid url');
            }

            //Validate the experience
            $yrs = $_POST['yrs'];
            if (Validate::validExperience($yrs)) {
                $_SESSION['newApplicant']->setExperience($yrs);
            } else {
                $this->_f3->set('errors["yrs"]',
                    'Experience is invalid');
            }
                //Redirect to the next page
                //if there are no errors
                if (empty($this->_f3->get('errors'))) {
                    //if applicant is mail type, go to apply3, else go to summary
                    if ($_SESSION['newApplicant'] instanceof Applicant_SubscribedToList){
                       $this->_f3->reroute('apply3');
                    } else {
                        $this->_f3->reroute('summary');
                    }
                }
        }

            //Add radio button arrays from data-layer to F3 hive
            $this->_f3->set('experience', DataLayer::getExperience());
            $this->_f3->set('relo', DataLayer::getRelo());

            $view = new Template();
            echo $view->render('views/experience.html');
    }

    /**
     * Job openings page method
     *
     * this method displays the job-openings page if the applicant has checked
     * the box to be on mailing lists. It validates the checkboxes and routes
     * them to the summary page
     * @return void
     */
    function apply3()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $jchoice = $_POST['jchoice'];
            //check to see if any boxes have been selected
            if (isset($jchoice)) {
                //if so, run validation
                if (Validate::validSelectionsJobs($jchoice)) {
                    //add to object
                    $jchoiceString = implode(", ", $_POST['jchoice'] );
                    $_SESSION['newApplicant']->setSelectionsJobs($jchoiceString);
                } else {
                    $this->_f3->set('errors["job"]',
                        'Job selection is invalid');
                }
            } else {//make sure to update the session variable
                $_SESSION['jchoice'] = $jchoice;
            }

            $vchoice = $_POST['vchoice'];
            if (isset($vchoice)) {
                if (Validate::validSelectionsVerticals($vchoice)) {
                    $vchoiceString = implode(", ", $_POST['vchoice']);
                    $_SESSION['newApplicant']->setSelectionsVerticals($vchoiceString);
                } else {
                    $this->_f3->set('errors["vertical"]',
                        'Vertical selection is invalid');
                }
            } else {
                $_SESSION['vchoice'] = $vchoice;
            }

            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('summary');
            }
        }

        //add checkboxes to f3 hive
        $this->_f3->set('jobs', DataLayer::getJobs());
        $this->_f3->set('verticals', DataLayer::getVerticals());
        $view = new Template();
        echo $view->render('views/job-openings.html');
    }

    /**
     * Summary page displays the summary and ends the session
     * @return void
     */
    function summary()
    {
        $view = new Template();
        echo $view->render('views/summary-page.html');
        session_destroy();
    }
}