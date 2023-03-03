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
 */
class Applicant_SubscribedToList extends Applicant
{
    private $_selectionsJobs;
    private $_selectionsVerticals;

    function __construct()
    {
        parent::__construct($fname="?", $lname="?", $email="?", $phone="?", $state="WA");
        $this->_selectionsJobs = [];
        $this->_selectionsVerticals = [];
    }

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

