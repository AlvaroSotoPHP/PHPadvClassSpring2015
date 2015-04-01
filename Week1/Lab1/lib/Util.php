<?php

//Util - functions used to help with the over all aplication

class Util
{
    //Method to check if a post reques has been made
    //@return boolean
    public function isPostRequest()
    {
        return (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST');
    }
    
    
    //Method to check if a get request has been made
    //@return boolean
    
    public function isGetResquest()
    {
        return (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET');
    }
}

?>

