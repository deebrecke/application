<?php
//Dee Brecke
//2/18/23
//328/application/model/validate.php
//this file contains all the validation functions for the application

//validate name by making sure string is all alphabetic
function validName($name){
    return ctype_alpha($name);
}

//check to see if string is valid url by using php function
function validGithub($github){
    return filter_var($github, FILTER_VALIDATE_URL);
}

//make field manditory and check that it is a valid choice
function validExperience($experience){
    return in_array($experience, getExperience());
}

//check for valid phone number using regex
function validPhone($phone){
    return preg_match('/^[0-9]{10}+$/', $phone);
}

//check for valid email using php function
function validEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

//check each selected jobs checkbox selection against a list of valid options
function validSelectionsJobs($jchoice)//pass in post[] (variable created in controller
{
    {
        $jarray = getJobs();//array to check against
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
function validSelectionsVerticals($vchoice)
{
    $varray = getVerticals();
    foreach ($vchoice as $choice) {
        if (!in_array($choice, $varray)) {
            return false;
        }
    }
    return true;
}


