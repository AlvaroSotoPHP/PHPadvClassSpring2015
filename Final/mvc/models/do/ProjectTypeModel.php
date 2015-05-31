<?php

/**
 * Description of PhotoTypeModel
 *
 * @author User
 */

namespace App\models\services;


class ProjectTypeModel extends BaseModel {
    
    private $projecttypeid;
    private $projecttype;
    private $active;
    
    function getProjecttypeid() {
        return $this->projecttypeid;
    }

    function getProjecttype() {
        return $this->projecttype;
    }

    function getActive() {
        return $this->active;
    }

    function setProjecttypeid($projecttypeid) {
        $this->projecttypeid = $projecttypeid;
    }

    function setProjecttype($projecttype) {
        $this->projecttype = $projecttype;
    }

    function setActive($active) {
        $this->active = $active;
    }


}
