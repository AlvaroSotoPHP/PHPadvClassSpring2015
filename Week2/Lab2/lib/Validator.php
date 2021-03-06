<?php
namespace asoto\week2;
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
    
    public function activeIsValid($type) {
        return ( is_string($type) && preg_match("/^[0-1]$/", $type) );
    }


}
