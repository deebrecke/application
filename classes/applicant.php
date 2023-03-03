<?php

/**
 * Applicant (Parent) class
 *
 * Dee Brecke
 * 328/application/classes/applicant.php
 * 3/2/2023
 * This class is the parent class for applicants. It contains all of the
 * personal data, but not any mailing lists. It has 5 required fields with the
 * state field being defaulted to WA
 */
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

    /**
     * parameterized constructor
     * @param $fname applicant's first name
     * @param $lname applicant's last name
     * @param $email applicant's email address
     * @param $phone applicant's phone number
     * @param $state State where applicant lives
     */
    function __construct($fname, $lname, $email, $phone, $state="WA")
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_state = $state;
        $this->_phone = $phone;
        $this->_github = "";
        $this->_experience = "";
        $this->_relocate = "";
        $this->_bio = "";
    }

    //getters and setters for each field:
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

    public function getGithub()
    {
        return $this->_github;
    }

    public function setGithub($github)
    {
        $this->_github = $github;
    }
    public function getExperience()
    {
        return $this->_experience;
    }

    public function setExperience($experience)
    {
        $this->_experience = $experience;
    }

    public function getRelocate()
    {
        return $this->_relocate;
    }

    public function setRelocate($relocate)
    {
        $this->_relocate = $relocate;
    }

    public function getBio()
    {
        return $this->_bio;
    }

    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}
