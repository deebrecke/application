<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/../config.php');
/**
 * Data Layer class
 *
 * Dee Brecke
 * 3/3/2023
 * 328/application/model/data-layer.php
 * This class holds the data arrays used in the templates
 * and contains functions for interacting with the database using PDO
 * and prepared statements
 */

class DataLayer
{
    private $_dbh;
    private $_applicant_id;
    public function __construct()
    {
        try{
            $this->_dbh = new PDO(DB_DRIVER, USERNAME, PASSWORD);
            //echo 'connect to database';
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    //array for experience radio buttons
    static function getExperience()
    {
        return array(" 0-2", " 2-4", " 4+");
    }

    //array for relocation radio buttons
    static function getRelo()
    {
        return array(" Yes", " No", " Maybe");
    }

    //array for jobs checkboxes
    static function getJobs()
    {
        return array("JavaScript", "PHP", "Java", "Python", "HTML", "CSS", "ReactJS", "NodeJS");
    }

    //array for verticals checkboxes
    static function getVerticals()
    {
        return array("SaaS", "Health tech", "Ag tech", "HR tech", "Industrial tech", "Cybersecurity");
    }

    //array of States dropdown
    static function getStates()
    {
        return array('Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','Florida','Georgia','Guam','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington','West Virginia','Wisconsin','Wyoming');
    }

    /**
     * This function takes in the applicant object that is instantiated in the controller.
     * It uses PDO and prepared statements to put all data into the database.
     * It combines the mailing lists if the signup box is checked, and inserts an empty
     * string  if it is not checked.
     * @param $appObj
     * @return id: applicant id of the last application inserted into the database
     */
    function insertApplicant($appObj)
    {
        //1. define query
        $sql = "INSERT INTO applicant (fname, lname, email, phone, state, github, experience, relocate, bio, mailing_lists_signup, mailing_list_subscriptions) 
            VALUES (:fname, :lname, :email, :phone, :state, :github, :experience, :relocate, :bio, :mailing_lists_signup, :mailingList)";

        //2. prepare statement (always the same)
        $statement = $this->_dbh->prepare($sql);

        //3. bind parameters
        $fname = $appObj->getFName();
        $lname = $appObj->getLName();
        $email = $appObj->getEmail();
        $phone = $appObj->getPhone();
        $state = $appObj->getState();
        $github = $appObj->getGithub();
        $experience = $appObj->getExperience();
        $relocate = $appObj->getRelocate();
        $bio = $appObj->getBio();
        $mailing_lists_signup = $appObj->getMailingListChoice();

        if($appObj instanceof Applicant_SubscribedToList){
            $mailingList = $appObj->getSelectionsJobs().", ".$appObj->getSelectionsVerticals();
        }else{
            $mailingList = "";
        }

        $statement->bindParam(':fname', $fname);
        $statement->bindParam(':lname', $lname);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':state', $state);
        $statement->bindParam(':github', $github);
        $statement->bindParam(':experience', $experience);
        $statement->bindParam(':relocate', $relocate);
        $statement->bindParam(':bio', $bio);
        $statement->bindParam(':mailing_lists_signup', $mailing_lists_signup);
        $statement->bindParam(':mailingList', $mailingList);

        //4. execute query (always the same)
        $statement->execute();

        //5. process results
        $id = $this->_dbh->lastInsertId();
        return $id;
    }

    /**
     * This function interacts with the database to pull all applicant data
     * from the database to be displayed on the Admin page sorted alphabetically
     * by last name
     * @return array of all applicant objects in database
     */
    function getApplicants()
    {
        //run sql select * function here
        $sql = "SELECT * FROM applicant ORDER BY lname";
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * This function takes in an applicant id and returns that
     * line from the database. (This is part of the extra credit challenge
     * that I opted out of for this assignment)
     * @param $applicant_id : primary key associated with a line in the database
     * @return all data pertaining to that applicant
     */
    function getApplicant($applicant_id)
    {
        $sql = "SELECT * FROM `applicant` WHERE applicant_id = $applicant_id";
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * This function takes in an applicant id and returns the subscriptions associated
     * with that applicant from the database. (This is part of the extra credit challenge
     * that I opted out of for this assignment)
     * @param $applicant_id: primary key associated with a line in the database
     * @return subscriptions that this particular applicant signed up for
     */
    function getSubscriptions($applicant_id)
    {
        $sql = "SELECT mailing_list_subscriptions FROM `applicant` WHERE applicant_id = $applicant_id";
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}//end of class

