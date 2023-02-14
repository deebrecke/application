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
    return true;
}

function validEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validSelectionsJobs($jobs){
    return in_array($jobs, getJobs());
}

function validSelectionsVerticals($verticals){
    return true;
}

//required fields: “First Name”, “Last Name”, “Email”, “Phone”, “Github Link”, and “Years Experience”

