<?php
namespace asoto\week2;
use PDO;
class EmailsDAO implements IDAO2
{
    
     private $db;
    
    function getDB() {
        return $this->db;
    }
    function setDB($db) {
        $this->db = $db;
    }
    
    public function __construct( PDO $db ) {        
        $this->setDB($db);    
    }   
    
    public function delete($id) {
        $db = $this->getDB();         
         $stmt = $db->prepare("Delete FROM email WHERE emailid = :emailid");
         
         if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
             return true;
         }
         
         return false;
    }

    public function getAllRows() {
        $values = array();          
         $db = $this->getDB();               
         $stmt = $db->prepare("SELECT email.emailid, email.email, email.emailtypeid, emailtype.emailtype, emailtype.active as emailtypeactive, email.logged, email.lastupdated, email.active" 
                  . " FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid"); 
          
         if ( $stmt->execute() && $stmt->rowCount() > 0 ) { 
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  
             foreach ($results as $value) { 
                $model = new EmailsModel(); 
                $model->reset()->map($value); 
                $values[] = $model; 
             } 
               
         }   else {             
             echo 'No data';
         }   
          
         $stmt->closeCursor();          
          return $values; 

    }

    public function getById($id) {
         $model = new EmailsModel();
          $db = $this->getDB(); 
           
          $stmt = $db->prepare("SELECT email.emailid, email.email, email.emailtypeid, emailtype.emailtype, emailtype.active as emailtypeactive, email.logged, email.lastupdated, email.active" 
                  . " FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid WHERE emailid = :emailid"); 
           
          if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) { 
              $results = $stmt->fetch(PDO::FETCH_ASSOC); 
              $model->map($results); 
          } 
           
          return $model; 

    }

    public function idExisit($id) {
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT emailid FROM email WHERE emailid = :emailid");
         
        if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }

    public function save(IModel $model) {
        $db = $this->getDB(); 
           
          $values = array( ":email" => $model->getEmail(), 
                           ":active" => $model->getActive(), 
                           ":emailtypeid" => $model->getEmailTypeId(), 
               
                     ); 
           
                  
          if ( $this->idExisit($model->getEmailid()) ) { 
              $values[":emailid"] = $model->getEmailId(); 
              $stmt = $db->prepare("UPDATE email SET email = :email, emailtypeid = :emailtypeid,  active = :active, lastupdated = now() WHERE emailid = :emailid"); 
          } else {              
              $stmt = $db->prepare("INSERT INTO email SET email = :email, emailtypeid = :emailtypeid, active = :active, logged = now(), lastupdated = now()"); 
          } 
           
            
          if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) { 
             return true; 
          } 
           
          return false; 

    }

}

