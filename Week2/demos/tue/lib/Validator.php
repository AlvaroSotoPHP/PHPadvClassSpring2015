<?php

/**
 * Validator Class
 * 
 * A collection of functions used to validate data
 *
 * @author Gabriel Forti
 */
class Validator {

    /**
     * A method to check if an email is valid.
     *
     * @param {String} [$email] - must be a valid email
     *
     * @return boolean
     */
    public function emailIsValid($email) {
        return ( is_string($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false );
    }

    /**
     * A method to check if the email type is valid.
     *
     * @param {String} [$email] - must be a valid email type
     *
     * @return boolean
     */
    public function emailTypeIsValid($email) {
        return ( is_string($email) && !empty($email) );
    }
    
    
    /**
     * A method to check if a email number is valid.
     *
     * @param {String} [$email] - must be a valid email number
     *
     * @return boolean
     */
    public function emailIsValid($email) {
        return ( preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $email) );
    }
    
    /**
     * A method to check if a email type is valid.
     *
     * @param {String} [$type] - must be a valid string
     *
     * @return boolean
     */
    public function emailTypeIsValid($type) {
        return ( is_string($type) && preg_match("/^[a-zA-Z]+$/", $type) );
    }
    
    /**
     * A method to check if a email type is valid.
     *
     * @param {String} [$type] - must be a valid string
     *
     * @return boolean
     */
    public function activeIsValid($type) {
        return ( is_string($type) && preg_match("/^[0-1]$/", $type) );
    }

}
