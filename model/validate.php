<?php
function validName($name){
    return ctype_alpha($name);
}

function validGithub($github){
    return true;
}

function validExperience($experience){
    return in_array($experience, getExperience());
}

function validPhone($phone){
    return true;
}

function validEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validSelectionsJobs($jobs){
    return true;
}

function validSelectionsVerticals($verticals){
    return true;
}

//required fields: “First Name”, “Last Name”, “Email”, “Phone”, “Github Link”, and “Years Experience”
// $email = test_input($_POST["email"]);
//if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//  $emailErr = "Invalid email format";
//}