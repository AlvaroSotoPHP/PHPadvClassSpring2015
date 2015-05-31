<?php
/**
 * Description of ProjectDAO
 *
 * @author GFORTI
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;


class ProjectDAO extends BaseDAO implements IDAO {
        
     public function __construct( PDO $db, IModel $model, ILogging $log ) {        
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
    
    
    public function idExisit($id) {
                
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT projectid FROM project WHERE projectid = :projectid");
         
        if ( $stmt->execute(array(':projectid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function read($id) {
         
         $model = clone $this->getModel();
         
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT project.projectid, project.project, project.projecttypeid, projecttype.projecttype, projecttype.active as projecttypeactive, project.logged, project.lastupdated, project.active"
                 . " FROM project LEFT JOIN projecttype on project.projecttypeid = projecttype.projecttypeid WHERE projectid = :projectid");
         
        if ( $stmt->execute(array(':projectid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
        }
         
        return $model;
         
        
    }
    
    
    public function create(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":project" => $model->getProject(),
                         ":active" => $model->getActive(),
                         ":projecttypeid" => $model->getProjecttypeid()             
                    );
                         
         if ( !$this->idExisit($model->getProjectid()) ) {
             
             $stmt = $db->prepare("INSERT INTO project SET project = :project, projecttypeid = :projecttypeid, active = :active, logged = now(), lastupdated = now()");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             }
         }
                  
         
         return false;
    }
    
    
     public function update(IModel $model) {
                 
         $db = $this->getDB();
         
        $binds = array( ":project" => $model->getProject(),
                        ":active" => $model->getActive(),
                        ":projecttypeid" => $model->getProjecttypeid(),
                        ":projectid" => $model->getProjectid()
                    );
         
                
         if ( $this->idExisit($model->getProjectid()) ) {
            
             $stmt = $db->prepare("UPDATE project SET project = :project, projecttypeid = :projecttypeid,  active = :active, lastupdated = now() WHERE projectid = :projectid");
         
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             } else {
                 $error = implode(",", $db->errorInfo());
                 $this->getLog()->logError($error);
             }
             
         } 
         
         return false;
    }
    
    public function delete($id) {
          
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM project WHERE projectid = :projectid");

        if ( $stmt->execute(array(':projectid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        } else {
            $error = implode(",", $db->errorInfo());
            $this->getLog()->logError($error);
        }
         
         return false;
    }
    
    public function getAllRows() {
       $db = $this->getDB();
       $values = array();
       
        $stmt = $db->prepare("SELECT project.projectid, project.project, project.projecttypeid, projecttype.projecttype, projecttype.active as projecttypeactive, project.logged, project.lastupdated, project.active"
                 . " FROM project LEFT JOIN projecttype on project.projecttypeid = projecttype.projecttypeid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = clone $this->getModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
        }
        
        $stmt->closeCursor();
         return $values;
    }
    
    
}
