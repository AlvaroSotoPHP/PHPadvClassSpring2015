<?php
namespace asoto\week2;
class EmailTypeModel implements IModel
{
    
    private $emailtype;
    private $active;
    private $emailtypeid;
    
    
    function getEmailType()
    {
        return $this->emailtype;
    }
    
    function getActive()
    {
        return $this->active;
    }
    
    function getEmailTypeId()
    {
        return $this->emailtypeid;
    }
    
    function setEmailType($emailType)
    {
        $this->emailtype = $emailType;
    }
    
    function setActive($Active)
    {
        $this->active = $Active;
    }
    
    function setEmailtypeid($emailtypeid) { 
             $this->emailtypeid = $emailtypeid; 
     } 

    public function map(array $values) {
        
        if (array_key_exists('emailtype', $values))
        {
            $this->setEmailType($values['emailtype']);
        }
        
        if (array_key_exists('active', $values))
        {
            $this->setActive($values['active']);
        }
        
        if(array_key_exists('emailtypeid', $values))
        {
            $this->setEmailtypeid($values['emailtypeid']);
        }
        
        return $this;
    }

    public function reset() {
        $this->SetEmailType('');
        $this->setActive('');
        
        return $this;
    }
    

}

