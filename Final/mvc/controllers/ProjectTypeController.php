<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjecttypeController
 *
 * @author User
 */

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class ProjecttypeController extends BaseController implements IController {
       
    public function __construct( IService $ProjectTypeService ) {                
        $this->service = $ProjectTypeService;     
        
    }


    public function execute(IService $scope) {
                
        $this->data['model'] = $this->service->getNewProjectTypeModel();
        $this->data['model']->reset();
        $viewPage = 'projecttype';
        
        
        if ( $scope->util->isPostRequest() ) {
            
            if ( $scope->util->getAction() == 'create' ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["saved"] = $this->service->create($this->data['model']);
                //var_dump($this->data["saved"]);
            }
            
            if ( $scope->util->getAction() == 'update'  ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["updated"] = $this->service->update($this->data['model']);
                 $viewPage .= 'edit';
            }
            
            if ( $scope->util->getAction() == 'edit' ) {
                $viewPage .= 'edit';
                $this->data['model'] = $this->service->read($scope->util->getPostParam('projecttypeid'));
                  
            }
            
            if ( $scope->util->getAction() == 'delete' ) {                
                $this->data["deleted"] = $this->service->delete($scope->util->getPostParam('projecttypeid'));
            }
            
            if ( $scope->util->getAction() == 'logout' ) {
                $scope->util->endSession();
                $scope->util->redirect('login', array());
            }
                       
        }
        
        
       
        $this->data['ProjectTypes'] = $this->service->getAllRows();        
        
        
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
    }
    
    
}
