<?php

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class SignUpController extends BaseController implements IController {
       
    public function __construct( IService $SignUpService ) {                
        $this->service = $SignUpService;     
        
    }


    public function execute(IService $scope) {
                
        $this->data['model'] = $this->service->getAccountModel();
        $this->data['model']->reset();
        $viewPage = 'signup';
        
        
        if ( $scope->util->isPostRequest() ) {
            
            if ( $scope->util->getAction() == 'create' ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["saved"] = $this->service->create($this->data['model']);
            }
                       
        }
              
        
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
    }
    
    
}
