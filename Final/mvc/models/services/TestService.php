<?php

/**
 * Description of TestService
 *
 * @author GFORTI
 */

namespace App\models\services;

//use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
//use App\models\interfaces\IModel;


class TestService implements IService{
    
    //test service...no use in the final
    public function validateForm($email) {
        
        if ( !empty($email) ) {
            return true;
        }
        return false;
        
    }
    
}
