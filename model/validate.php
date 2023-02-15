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

function validSelectionsVerticals($verticals){
    return in_array($verticals, getVerticals());
}

//required fields: “First Name”, “Last Name”, “Email”, “Phone”, “Github Link”, and “Years Experience”

