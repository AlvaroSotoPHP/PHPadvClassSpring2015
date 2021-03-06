<?php

/**
 * Description of PhotoTypeModel
 *
 * @author User
 */

namespace App\models\services;


class PhoneTypeModel extends BaseModel {
    
    private $emailtypeid;
    private $emailtype;
    private $active;
    
    function getPhonetypeid() {
        return $this->emailtypeid;
    }

    function getPhonetype() {
        return $this->emailtype;
    }

    function getActive() {
        return $this->active;
    }

    function setPhonetypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }

    function setPhonetype($emailtype) {
        $this->emailtype = $emailtype;
    }

    function setActive($active) {
        $this->active = $active;
    }


}
