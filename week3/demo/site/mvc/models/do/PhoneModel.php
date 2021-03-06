<?php

/**
 * Description of PhoneModel
 *
 * @author GFORTI
 */

namespace App\models\services;


class PhoneModel extends BaseModel {
    
    private $emailid;
    private $email;
    private $emailtypeid;
    private $emailtype;
    private $emailtypeactive;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getPhoneid() {
        return $this->emailid;
    }

    function getPhone() {
        return $this->email;
    }

    function getPhonetypeid() {
        return $this->emailtypeid;
    }
    
     function getPhonetype() {
        return $this->emailtype;
    }

    function getPhonetypeactive() {
        return $this->emailtypeactive;
    }

    function getLogged() {
        return $this->logged;
    }

    function getLastupdated() {
        return $this->lastupdated;
    }

    function getActive() {
        return $this->active;
    }

    function setPhoneid($emailid) {
        $this->emailid = $emailid;
    }

    function setPhone($email) {
        $this->email = $email;
    }

    function setPhonetypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }

    function setPhonetype($emailtype) {
        $this->emailtype = $emailtype;
    }

    function setPhonetypeactive($emailtypeactive) {
        $this->emailtypeactive = $emailtypeactive;
    }
    
    function setLogged($logged) {
        $this->logged = $logged;
    }

    function setLastupdated($lastupdated) {
        $this->lastupdated = $lastupdated;
    }

    function setActive($active) {
        $this->active = $active;
    }
    
}
