<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectTypeService
 *
 * @author User
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class ProjectTypeService implements IService {
    
     protected $DAO;
     protected $validator;
     protected $model;
             
     //Function to get validator
     function getValidator() {
         return $this->validator;
     }

     //Function to set validator
     function setValidator($validator) {
         $this->validator = $validator;
     }

     //Function to get the model
     function getModel() {
         return $this->model;
     }

     //Function to set the model
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

     //Default constructor. receives objets to be use to perform service actions
    public function __construct( IDAO $ProjectTypeDAO, IService $validator,IModel $model  ) {
        $this->setDAO($ProjectTypeDAO);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    //Most of these functions does not have a use in the program
    //Function to get all rows
    public function getAllRows($limit = "", $offset = "") {
        return $this->getDAO()->getAllRows($limit, $offset);
    }
    
    //Function to check if id already exists in the db
    public function idExist($id) {
        return $this->getDAO()->idExisit($id);
    }
    
    //Function to read record based on id
    public function read($id) {
        return $this->getDAO()->read($id);
    }
    
    //Function to delete a record based on the id
    public function delete($id) {
        return $this->getDAO()->delete($id);
    }
    
    //Function to create another record to the db
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->create($model);
        }
        return false;
    }
    
    //Function to update a record in the db based on the model info
    public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getDAO()->update($model);
        }
        return false;
    }
    
    //Function to validate the project type and project activeness
    //Returns an array of errors
    public function validate( IModel $model ) {
        $errors = array();
        if ( !$this->getValidator()->projectTypeIsValid($model->getProjecttype()) ) {
            $errors[] = 'Project Type is invalid';
        }
               
        if ( !$this->getValidator()->activeIsValid($model->getActive()) ) {
            $errors[] = 'Project active is invalid';
        }
       
        
        return $errors;
    }
    
    
    //Function to get the project model
    public function getNewProjectTypeModel() {
        return clone $this->getModel();
    }
    
    
}
