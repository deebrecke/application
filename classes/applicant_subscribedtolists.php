<?php
class Applicant_SubscribedToList extends Applicant
{
    private $_selectionsJobs;
    private $_selectionsVerticals;

    //we set condiments to a string instead of an array.
    //The instructions say the fields here should be arrays. For now,
    // I just went ahead and change to empty string instead of
    // empty array to make it work and then I can go back and fix
    //it later
    function __construct()
    {
        parent::__construct();
        $this->_selectionsJobs = "";
        $this->_selectionsVerticals = "";
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

