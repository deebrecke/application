<?php

class Applicant
{
    private $_fname;
    private $_lname;
    private $_email;
    private $_state;
    private $_phone;
    private $_github;
    private $_experience;
    private $_relocate;
    private $_bio;

    function __construct()
    {
        $this->_fname = "";
        $this->_lname = "";
        $this->_email = "";
        $this->_state = "";
        $this->_phone = "";
    }

    public function getFName()
    {
        return $this->_fname;
    }

    public function setFName($fname)
    {
        $this->_fname = $fname;
    }

    public function getLName()
    {
        return $this->_lname;
    }

    public function setLName($lname)
    {
        $this->_lname = $lname;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getState()
    {
        return $this->_state;
    }

    public function setState($state)
    {
        $this->_state = $state;
    }

    public function getPhone()
    {
        return $this->_phone;
    }

    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

}
