<?php

/**
 * Applicant Subscribed to lists (child) class
 *
 * Dee Brecke
 * 3/3/2023
 * 328/applicant/classes/applicant_subscribedtolists.php
 * This class is the child of the Applicant class. If the applicant selects the
 * box for mailing lists, this is the object that is created. It contains all of the
 * fields that the parent Applicant class contains, plus two arrays for the checkboxes
 * The mailing lists field is defaulted to 12, so that if the Applicant_SubscribedToList
 * object is created, the field is changed before being put into the database
 */
class Applicant_SubscribedToList extends Applicant
{
    private $_selectionsJobs;
    private $_selectionsVerticals;

    /**
     * Parameterized constructor
     */
    function __construct()
    {
        parent::__construct($fname="?", $lname="?", $email="?", $phone="?", $state="WA");
        $this->_selectionsJobs = [];
        $this->_selectionsVerticals = [];
        $this->_mailingLists = 1;
    }

//getters and setters for the class
    public function getSelectionsJobs()
    {
        return $this->_selectionsJobs;
    }

    public function setSelectionsJobs($selectionsJobs)
    {
        $this->_selectionsJobs = $selectionsJobs;
    }

    public function getSelectionsVerticals()
    {
        return $this->_selectionsVerticals;
    }

    public function setSelectionsVerticals($selectionsVerticals)
    {
        $this->_selectionsVerticals= $selectionsVerticals;
    }

}

