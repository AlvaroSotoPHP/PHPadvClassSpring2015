<?php


namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class LoginService implements IService {
    
     protected $DAO;
     protected $validator;
     protected $model;
       
     //Most of the functions are access when the service is created or when is going to be used
     //To set the necessesary files to run the service
     
     //Function to get the validator
     function getValidator() {
         return $this->validator;
     }

     //function to set the validator
     function setValidator($validator) {
         $this->validator = $validator;
     }

     //function to get the model
     function getModel() {
         return $this->model;
     }

     //function to set the model
     function setModel(IModel $model) {
         $this->model = $model;
     }
     
     //Function to get the DAO
     function getDAO() {
         return $this->DAO;
     }

     //Function to set the DAO
     function setDAO(IDAO $DAO) {
         $this->DAO = $DAO;
     }
     
     //Function to validate login credentials using the model's stored information
     public function login($model) {
        return $this->getDAO()->login($model);
    }

    //DEfault construnctor that receives the DAO (Database access object), the Model and the validator
    public function __construct( IDAO $SignupDAO, IService $validator,IModel $model  ) {
        $this->setDAO($SignupDAO);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    //Functions inherited by past programs
    ////All these functions use the DAO
    //Getting all the rows
    public function getAllRows($limit = "", $offset = "") {
        return $this->getDAO()->getAllRows($limit, $offset);
    }
    
    //Checking if ID already exists
    public function idExist($id) {
        return $this->getDAO()->idExisit($id);
    }
    
    //function to read an entry in the databse based on ID
    public function read($id) {
        return $this->getDAO()->read($id);
    }
    
    //Function to delete a record in the database based on the id
    public function delete($id) {
        return $this->getDAO()->delete($id);
    }
    
    //function to create a new entry in the database
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->create($model);
        }
        return false;
    }
    
    //Function to updatea  record in the database
    public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->update($model);
        }
        return false;
    }
    
    //Function to validate the email provided inside the model
    public function validate( IModel $model ) {
        $errors = array();
        if ( !$this->getValidator()->emailTypeIsValid($model->getEmailtype()) ) {
            $errors[] = 'Email Type is invalid';
        }
               
        if ( !$this->getValidator()->activeIsValid($model->getActive()) ) {
            $errors[] = 'Email active is invalid';
        }
       
        
        return $errors;
    }
    
    //Function to get the provided model
    public function getAccountModel() {
        return clone $this->getModel();
    }
    
    
}
