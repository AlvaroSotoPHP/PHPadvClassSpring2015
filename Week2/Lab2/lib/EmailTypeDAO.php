<?php
namespace asoto\week2;
use PDO;
class EmailTypeDAO implements IDAO2
{
    private $DB = null;
    
    public function __construct(PDO $db) {
        $this->setDB($db);
    }
    
    private function setDB(PDO $DB)
    {
        $this->DB = $DB;
    }
    
    private function getDB()
    {
        return $this->DB;
    }
    
    public function delete($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("DELETE FROM emailtype WHERE emailtypeid = :emailtypeid");
        
        if ($stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0)
        {
            return true;
        }

        return false;
    }

    public function getAllRows() {
        
        $values = array();
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM emailtype");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 )
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($results as $value)
            {
                $model = new EmailTypeModel();
                $model->reset()->map($value);
                $values[] = $model;
            }
        }
        else
        {
            //the insert did not work
            echo "it did not work";
            //log($db->errorInfo() ) ;
        }
        
        $stmt->closeCursor();
        return $values;
        
    }

    public function save(IModel $model) {
        
        $db = $this->getDB();
         
         $values = array(":emailtype"=>$model->getEmailType(),
                        ":active"=>$model->getActive()
        );
            
        if ($this->idExisit($model->getEmailTypeId()))
        {
            $values[":emailtypeid"] = $model->getEmailtypeId();
            $stmt = $db->prepare("UPDATE emailtype SET emailtype = :emailtype, active = :active WHERE emailtypeid = :emailtypeid");
        }
        else
        {
        $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype, active = :active");
        }
         
          
         if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            return true;
         }
         
         return false;
        
    }

    public function getById($id) {
        //$model = new EmailType();
        $model = new EmailTypeModel();
        $db = $this->getDB();
         
        $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
         
         if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);            
         }
         
         return $model;
    }

    public function idExisit($id) {
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
        
        if($stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) 
        {
            return true;
        }
        return false;
    }

}

?>

