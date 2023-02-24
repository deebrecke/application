<?php
class Applicant_SubscribedToList extends Applicant
{
    private $_selectionsJobs;
    private $_selectionsVerticals;

    function __construct()
    {
        parent::__construct();
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

