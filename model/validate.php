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

function validSelectionsJobs($jobs){
    return in_array($jobs, getJobs());
}

function validSelectionsVerticals()
{
    $varray = getVerticals();
    foreach ($varray as $vselect) {
        if (in_array($vselect, $varray)) {
            return false;
        }
    }
    return true;
}


//if(isset($_POST['interest'])):
//    $cnt=0;
//    foreach($_POST['interest'] as $interest):
//        //Validate
//        if(in_array($interest,$interests)):
//            $cnt++;
//            //Check count
//            if($cnt <= 5):
//                //Do processing of first five here
//
//            endif;
//required fields: “First Name”, “Last Name”, “Email”, “Phone”, “Github Link”, and “Years Experience”

