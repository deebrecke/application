<?php
function validName($fname){
    return strlen($fname) > 2;
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
    return true;
}

function validSelectionsJobs($jobs){
    return true;
}

function validSelectionsVerticals($verticals){
    return true;
}