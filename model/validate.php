<?php

/**
 * Validation Class
 *
 * Dee Brecke
 * 3/3/2023
 * 328/application/model/validate.php
 * This class contains all the validation functions and methods for the application
 */
class Validate
{
    //validate name by making sure string is all alphabetic
    static function validName($name)
    {
        return ctype_alpha($name);
    }

    //check to see if string is valid url by using php function
    static function validGithub($github)
    {
        return filter_var($github, FILTER_VALIDATE_URL);
    }

    //make field manditory and check that it is a valid choice
    static function validExperience($experience)
    {
        return in_array($experience, DataLayer::getExperience());
    }

    //check for valid phone number using regex
    static function validPhone($phone)
    {
        return preg_match('/^[0-9]{10}+$/', $phone);
    }

    //check for valid email using php function
    static function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validation method for Industry Verticals checkboxes
     *
     * This method checks each selected jobs checkbox selection against a list of valid options
     * by calling the function containing the options
     * @param $jchoice Post[] variable that was created in the controller
     * @return bool true if no spoofing has occurred (all values are in original array)
     */
    static function validSelectionsJobs($jchoice)
    {
        {
            $jarray = DataLayer::getJobs();//array to check against
            foreach ($jchoice as $choice) {
                if (!in_array($choice, $jarray)) {//if selection is not in array
                    return false;
                }
            }
            //if you get this far, then it's all valid
            return true;
        }
    }

    /**
     * Validation method for Industry Verticals checkboxes
     *
     * This method checks each selected verticals checkbox selection against a list of valid options
     * by calling the function containing the options
     * @param $jchoice Post[] variable that was created in the controller
     * @return bool true if no spoofing has occurred (all values are in original array)
     */
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

