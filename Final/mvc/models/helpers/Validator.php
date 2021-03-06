<?php
/**
 * Description of Validator
 *
 * @author GForti
 */
namespace App\models\services;
use App\models\interfaces\IService;
class Validator implements IService {
    
    
    
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
    
    public function projectIsValid($email) {
        return ( is_string($email) && !empty($email) !== false );
    }
    
    /**
     * A method to check if a phone number is valid.
     *
     * @param {String} [$phone] - must be a valid phone number
     *
     * @return boolean
     */
    public function phoneIsValid($phone) {
        return ( preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone) );
    }
    
    /**
     * A method to check if a phone type is valid.
     *
     * @param {String} [$type] - must be a valid string
     *
     * @return boolean
     */
    public function phoneTypeIsValid($type) {
        return ( is_string($type) && preg_match("/^[a-zA-Z]+$/", $type) );
    }
    
    
    
    /**
     * A method to check if a phone type is valid.
     *
     * @param {String} [$type] - must be a valid string
     *
     * @return boolean
     */
    
    public function emailTypeIsValid($type) {
        return ( is_string($type) && preg_match("/^[a-zA-Z]+$/", $type) );
    }
    
    public function projectTypeIsValid($type) {
        return ( is_string($type) );
    }
    
    public function activeIsValid($type) {
        return ( is_string($type) && preg_match("/^[0-1]$/", $type) );
    }
}