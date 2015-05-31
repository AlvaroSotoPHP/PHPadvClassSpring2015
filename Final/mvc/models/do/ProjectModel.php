<?php

/**
 * Description of ProjectModel
 *
 * @author GFORTI
 */

namespace App\models\services;


class ProjectModel extends BaseModel {
    
    private $projectid;
    private $project;
    private $projecttypeid;
    private $projecttype;
    private $projecttypeactive;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getProjectid() {
        return $this->projectid;
    }

    function getProject() {
        return $this->project;
    }

    function getProjecttypeid() {
        return $this->projecttypeid;
    }
    
     function getProjecttype() {
        return $this->projecttype;
    }

    function getProjecttypeactive() {
        return $this->projecttypeactive;
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

    function setProjectid($projectid) {
        $this->projectid = $projectid;
    }

    function setProject($project) {
        $this->project = $project;
    }

    function setProjecttypeid($projecttypeid) {
        $this->projecttypeid = $projecttypeid;
    }

    function setProjecttype($projecttype) {
        $this->projecttype = $projecttype;
    }

    function setProjecttypeactive($projecttypeactive) {
        $this->projecttypeactive = $projecttypeactive;
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
