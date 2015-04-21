<?php
namespace asoto\week2;
interface IDAO2
{   
    public function getById($id);
    
    public function delete($id);
    
    public function save(IModel $model);
    
    public function getAllRows();
    
    public function idExisit($id);
}

