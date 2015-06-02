<?php

namespace App\models\services;

use App\models\interfaces\IService;

class Util implements IService {
    
    //Method to generate Link
    public function createLink($page, array $params = array()) {        
        return $page . '?' .http_build_query($params);
    }
    
    //redirect to the specify page
    public function redirect($page, array $params = array()) {
        header('Location: ' . $this->createLink($page, $params));
        die();
    }
    
    //Get the value of the url
    public function getUrlParam($name) {
        return filter_input(INPUT_GET, $name);
    }

    public function getPostParam($name) {
        $post = $this->getPostValues();
         if ( is_array($post) && isset($post[$name])  ) {
            return $post[$name];
         }
         return NULL;
    }
       
    public function getPostValues() {
        return filter_input_array(INPUT_POST);
    }
    
    public function getAction() {
        return $this->getPostParam('action');
    }
      
    
    public function getCurrentPage() {
        return $this->getUrlParam('page');
    }
    
    //Method to check if post request have been made
    public function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }
    
    //Method to check if get request was made
    public function isGetRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
    }
    
    //Method to check if user is logged in
    public function isLoggedin() {
        return ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true ); //session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
    }
    
    //Method to set the loggin session
    public function setLoggedin($value) {
        session_start();
        session_regenerate_id(true);
        $_SESSION['loggedin'] = $value;
    }
    //Mehotd to end the session
    public function endSession()
    {
        $_SESSION['loggedin'] = false;
        session_destroy();
    }
}


