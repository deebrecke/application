<?php
function validName($name){
    return ctype_alpha($name);
}

function validGithub($github){
    return filter_var($github, FILTER_VALIDATE_URL);
}

function validExperience($experience){
    return in_array($experience, getExperience());
}

function validPhone($phone){
    return preg_match('/^[0-9]{10}+$/', $phone);
}

function validEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validSelectionsJobs($jchoice)
{
    {
        $jarray = getJobs();
        foreach ($jchoice as $choice) {
            if (!in_array($choice, $jarray)) {
                return false;
            }
        }
        return true;
    }
}

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


