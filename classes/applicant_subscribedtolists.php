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
}

