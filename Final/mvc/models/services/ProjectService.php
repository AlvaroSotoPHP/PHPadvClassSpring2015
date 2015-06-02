<?php
/**
 * Description of ProjectService
 *
 * @author GFORTI
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class ProjectService implements IService {
    
    protected $projectDAO;
    protected $projectTypeService;
    protected $validator;
    protected $model;
    
    //Function to get the validator
    function getValidator() {
        return $this->validator;
    }

    //Function to set the validator passed in the constructor
    function setValidator($validator) {
        $this->validator = $validator;
    }                
     
    //Function to get the DAO
    function getProjectDAO() {
        return $this->projectDAO;
    }

    //Function to set the DAO passed in the construct
    function setProjectDAO(IDAO $DAO) {
        $this->projectDAO = $DAO;
    }
    
    //Function to get the service for the project type
    function getProjectTypeService() {
        return $this->projectTypeService;
    }

    //Function to set the service for the project type
    function setProjectTypeService(IService $service) {
        $this->projectTypeService = $service;
    }
    
    //Project to get the model
    function getModel() {
        return $this->model;
    }

    //Model to set the model
    function setModel(IModel $model) {
        $this->model = $model;
    }

    //DEfault constructor to receive and set necessary objects to perform actions
        public function __construct( IDAO $projectDAO, IService $projectTypeService, IService $validator, IModel $model  ) {
        $this->setProjectDAO($projectDAO);
        $this->setProjectTypeService($projectTypeService);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    
    //Function to get all the projects type
    public function getAllProjectTypes() {       
        return $this->getProjectTypeService()->getAllRows();   
        
    }
    
    //Function to get all the projects
     public function getAllProjects() {       
        return $this->getProjectDAO()->getAllRows();   
        
    }
    
    //Function to create a new project in the db
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getProjectDAO()->create($model);
        }
        return false;
    }
    
    
    //Function to validate the user input
    //Returns array of errors
    public function validate( IModel $model ) {
        $errors = array();
        
        if ( !$this->getProjectTypeService()->idExist($model->getProjecttypeid()) ) {
            $errors[] = 'Project Type is invalid';
        }
       
        if ( !$this->getValidator()->projectIsValid($model->getProject()) ) {
            $errors[] = 'Project is invalid';
        }
               
        if ( !$this->getValidator()->activeIsValid($model->getActive()) ) {
            $errors[] = 'Project active is invalid';
        }
       
        
        return $errors;
    }
    
    
    //Function to read a record in the db based on the id
    public function read($id) {
        return $this->getProjectDAO()->read($id);
    }
    
    //Function to delete a record based on the db
    public function delete($id) {
        return $this->getProjectDAO()->delete($id);
    }
    
    //Function to update a project
     public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getProjectDAO()->update($model);
        }
        return false;
    }
    
    //Function to get the model
     public function getNewProjectModel() {
        return clone $this->getModel();
    }
    
    
}
