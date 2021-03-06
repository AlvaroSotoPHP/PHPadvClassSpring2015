<?php
/**
 * Description of PhoneService
 *
 * @author GFORTI
 */

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class PhoneService implements IService {
    
    protected $emailDAO;
    protected $emailTypeService;
    protected $validator;
    protected $model;
                function getValidator() {
        return $this->validator;
    }

    function setValidator($validator) {
        $this->validator = $validator;
    }                
     
    function getPhoneDAO() {
        return $this->emailDAO;
    }

    function setPhoneDAO(IDAO $DAO) {
        $this->emailDAO = $DAO;
    }
    
    function getPhoneTypeService() {
        return $this->emailTypeService;
    }

    function setPhoneTypeService(IService $service) {
        $this->emailTypeService = $service;
    }
    
    
    function getModel() {
        return $this->model;
    }

    function setModel(IModel $model) {
        $this->model = $model;
    }

        public function __construct( IDAO $emailDAO, IService $emailTypeService, IService $validator, IModel $model  ) {
        $this->setPhoneDAO($emailDAO);
        $this->setPhoneTypeService($emailTypeService);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    
    public function getAllPhoneTypes() {       
        return $this->getPhoneTypeService()->getAllRows();   
        
    }
    
     public function getAllPhones() {       
        return $this->getPhoneDAO()->getAllRows();   
        
    }
    
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getPhoneDAO()->create($model);
        }
        return false;
    }
    
    
    public function validate( IModel $model ) {
        $errors = array();
        
        if ( !$this->getPhoneTypeService()->idExist($model->getPhonetypeid()) ) {
            $errors[] = 'Phone Type is invalid';
        }
       
        if ( !$this->getValidator()->emailIsValid($model->getPhone()) ) {
            $errors[] = 'Phone is invalid';
        }
               
        if ( !$this->getValidator()->activeIsValid($model->getActive()) ) {
            $errors[] = 'Phone active is invalid';
        }
       
        
        return $errors;
    }
    
    
    public function read($id) {
        return $this->getPhoneDAO()->read($id);
    }
    
    public function delete($id) {
        return $this->getPhoneDAO()->delete($id);
    }
    
    
     public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getPhoneDAO()->update($model);
        }
        return false;
    }
    
    
     public function getNewPhoneModel() {
        return clone $this->getModel();
    }
    
    
}
