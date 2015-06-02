<?php


namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class SignUpService implements IService {
    
     protected $DAO;
     protected $validator;
     protected $model;
             
     //Function to get the validator
     function getValidator() {
         return $this->validator;
     }

     //Function to set the validator
     function setValidator($validator) {
         $this->validator = $validator;
     }

     //Function to get the model
     function getModel() {
         return $this->model;
     }

     //Function to set the model given
     function setModel(IModel $model) {
         $this->model = $model;
     }
     
     //Function to get the Database access object
     function getDAO() {
         return $this->DAO;
     }

     //Function to set the DAO
     function setDAO(IDAO $DAO) {
         $this->DAO = $DAO;
     }

     //Default constructor to load the necessary files to perfrom service
    public function __construct( IDAO $SignupDAO, IService $validator,IModel $model  ) {
        $this->setDAO($SignupDAO);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    //function to get all the rows in the db
    public function getAllRows($limit = "", $offset = "") {
        return $this->getDAO()->getAllRows($limit, $offset);
    }
    
    //function to check if id already exist
    public function idExist($id) {
        return $this->getDAO()->idExisit($id);
    }
    
    //function to read record based on id
    public function read($id) {
        return $this->getDAO()->read($id);
    }
    
    //function to delete record based on id
    public function delete($id) {
        return $this->getDAO()->delete($id);
    }
    
    //Function to add a record to the table in the database
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->create($model);
        }
        return false;
    }
    
    //Function to update a record based on the database
    public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->update($model);
        }
        return false;
    }
    
    //Function to validate email
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
    
    //Function to get the model
    public function getAccountModel() {
        return clone $this->getModel();
    }
    
    
}
