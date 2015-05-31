<?php
/**
 * Description of ProjectTypeDAO
 *
 * @author User
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;

class ProjectTypeDAO extends BaseDAO implements IDAO {
    
    public function __construct( PDO $db, IModel $model, ILogging $log ) {        
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
          
    public function idExisit($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM projecttype WHERE projecttypeid = :projecttypeid");
         
        if ( $stmt->execute(array(':projecttypeid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function read($id) {
         
         $model = clone $this->getModel();
         
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT * FROM projecttype WHERE projecttypeid = :projecttypeid");
         
         if ( $stmt->execute(array(':projecttypeid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->reset()->map($results);
         }
         
         return $model;
    }
    
    
    public function create(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":projecttype" => $model->getProjecttype(),
                          ":active" => $model->getActive()
                    );
                         
         if ( !$this->idExisit($model->getProjecttypeid()) ) {
             
             $stmt = $db->prepare("INSERT INTO projecttype SET projecttype = :projecttype, active = :active");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             }
         }
                  
         
         return false;
    }
    
    
     public function update(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":projecttype" => $model->getProjecttype(),
                          ":active" => $model->getActive(),
                          ":projecttypeid" => $model->getProjecttypeid()
                    );
         
                
         if ( $this->idExisit($model->getProjecttypeid()) ) {
            
             $stmt = $db->prepare("UPDATE projecttype SET projecttype = :projecttype, active = :active WHERE projecttypeid = :projecttypeid");
         
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
        $stmt = $db->prepare("Delete FROM projecttype WHERE projecttypeid = :projecttypeid");

        if ( $stmt->execute(array(':projecttypeid' => $id)) && $stmt->rowCount() > 0 ) {
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
       
        $stmt = $db->prepare("SELECT * FROM projecttype");
        
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
