<?php
/**
 * Description of ProjectController
 *
 * @author GFORTI
 */

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class ProjectController extends BaseController implements IController {
   
    protected $service;
    
    public function __construct( IService $ProjectService  ) {                
        $this->service = $ProjectService;  
    }
    
    public function execute(IService $scope) {
        $viewPage = 'project';
        
        $this->data['model'] = $this->service->getNewProjectModel();
        $this->data['model']->reset();
        
        if ( $scope->util->isPostRequest() ) {
            
            
            if ( $scope->util->getAction() == 'create' ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["saved"] = $this->service->create($this->data['model']);
            }
            
            if ( $scope->util->getAction() == 'edit' ) {
                $viewPage .= 'edit';
                $this->data['model'] = $this->service->read($scope->util->getPostParam('projectid'));
                  
            }
            
            if ( $scope->util->getAction() == 'delete' ) {                
                $this->data["deleted"] = $this->service->delete($scope->util->getPostParam('projectid'));
            }
            
             if ( $scope->util->getAction() == 'update'  ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["updated"] = $this->service->update($this->data['model']);
                 $viewPage .= 'edit';
            }
            
            if ( $scope->util->getAction() == 'logout' ) {
                $scope->util->endSession();
                $scope->util->redirect('login', array());
            }
            
            
        }
        
        
        $this->data['projectTypes'] = $this->service->getAllProjectTypes(); 
        $this->data['projects'] = $this->service->getAllProjects(); 
        
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
    }
    
}
