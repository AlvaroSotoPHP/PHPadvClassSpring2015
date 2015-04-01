<?php

//Validator Class

//A colletion of functions used to validate data

class Validator
{
    //Method to check if an email is valid
    //@param{String}[@email] - must be a valid email
    //@return boolean
    
    public function emailIsValid($email)
    {
        return ( is_string($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false );
    }
    
    //Method to check if the email type is valid
    //@param {String} [$email] - must be a valid email type
    //@return boolean
    
    public function emailTypeIsValid($email)
    {
        return ( is_string($email) && !empty($email) );
    }
}
