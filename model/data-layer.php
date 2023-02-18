<?php
//Dee Brecke
//2/18/23
//328/application/model/data-layer.php
//This file holds the data arrays used in the templates

//array for experience radio buttons
function getExperience()
{
    return array(" 0-2", " 2-4", " 4+");
}

//array for relocation radio buttons
function getRelo()
{
    return array(" Yes", " No", " Maybe");
}

//array for jobs checkboxes
function getJobs()
{
    return array("JavaScript", "PHP", "Java", "Python", "HTML", "CSS", "ReactJS", "NodeJS");
}

//array for verticals checkboxes
function getVerticals()
{
    return array("SaaS", "Health tech", "Ag tech", "HR tech", "Industrial tech", "Cybersecurity");
}

function getStates()
{
    return array('Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','Florida','Georgia','Guam','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington','West Virginia','Wisconsin','Wyoming');
}