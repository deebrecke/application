<?php

class Validate
{
    //Dee Brecke
    //2/18/23
    //328/application/model/validate.php
    //this file contains all the validation functions for the application

    //validate name by making sure string is all alphabetic
    static function validName($name){
        return ctype_alpha($name);
    }

    //check to see if string is valid url by using php function
    static function validGithub($github){
        return filter_var($github, FILTER_VALIDATE_URL);
    }

    //make field manditory and check that it is a valid choice
    static function validExperience($experience){
        return in_array($experience, DataLayer::getExperience());
    }

    //check for valid phone number using regex
    static function validPhone($phone){
        return preg_match('/^[0-9]{10}+$/', $phone);
    }

    //check for valid email using php function
    static function validEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    //check each selected jobs checkbox selection against a list of valid options
    static function validSelectionsJobs($jchoice)//pass in post[] (variable created in controller
    {
        {
            $jarray = DataLayer::getJobs();//array to check against
            foreach($jchoice as $choice) {
                if(!in_array($choice, $jarray)) {//if selection is not in array
                    return false;
                }
            }
            //if you get this far, then it's all valid
            return true;
        }
    }

    //check each selected verticals checkbox selection against a list of valid options
    static function validSelectionsVerticals($vchoice)
    {
        $varray = DataLayer::getVerticals();
        foreach ($vchoice as $choice) {
            if (!in_array($choice, $varray)) {
                return false;
            }
        }
        return true;
    }
}

