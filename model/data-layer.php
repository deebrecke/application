<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/../config.php');
/**
 * Data Layer class
 *
 * Dee Brecke
 * 3/3/2023
 * 328/application/model/data-layer.php
 * This class holds the data arrays used in the templates
 */

class DataLayer
{
    private $_dbh;
    private $applicant_id;
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

    static function getStates()
    {
        return array('Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','Florida','Georgia','Guam','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington','West Virginia','Wisconsin','Wyoming');
    }

//same a s save order in diner
    function insertApplicant($appObj)
    {
        //1. define query
        $sql = "INSERT INTO applicant (fname, lname, email, phone, state, github, experience, relocate,bio) 
            VALUES (:fname, :lname, :email, :phone, :state, :github, :experience, :relocate, :bio)";

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

        $statement->bindParam(':fname', $fname);
        $statement->bindParam(':lname', $lname);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':phone', $phone);
        $statement->bindParam(':state', $state);
        $statement->bindParam(':github', $github);
        $statement->bindParam(':experience', $experience);
        $statement->bindParam(':relocate', $relocate);
        $statement->bindParam(':bio', $bio);

        //4. execute query (always the same)
        $statement->execute();

        //5. process results
        $id = $this->_dbh->lastInsertId();
        return $id;
        echo $id;
    }

    function getApplicants()
    {
        //run sql select * function here
        $sql = "SELECT * FROM applicant";
        $statement = $this->_dbh->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    function getApplicant($applicant_id){

    }

    function getSubscriptions($applicant_id){

    }
}//end of class

////5. Process Result
//$result = $statement->fetchAll(PDO::FETCH_ASSOC);
//foreach ($result as $row) {
////    echo "<p>".$row['id'].", ".$row['name'].", ".$row['type'].", ".$row['color']."</p>";
//// echo "<p>{$row['id']}, {$row['name']}, {$row['type']}, {$row['color']}</p>";
//
//    $id = $row['id'];
//    $name = $row['name'];
//    $color = $row['color'];
//    $type = $row['type'];
//
//    echo "<p>$id, $name, $color, $type";