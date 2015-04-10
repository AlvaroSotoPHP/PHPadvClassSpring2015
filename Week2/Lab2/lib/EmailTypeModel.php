<?php

class EmailTypeModel implements IModel
{
    
    private $emailtype;
    private $active;
    
    
    function getEmailType()
    {
        return $this->emailtype;
    }
    
    function getActive()
    {
        return $this->active;
    }
    
    function setEmailType($emailType)
    {
        $this->emailtype = $emailType;
    }
    
    function setActive($Active)
    {
        $this->active = $Active;
    }
    
    /*hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee!*/
    public function map(array $values) {
        
        if (array_key_exists('emailtype', $values))
        {
            $this->setEmailType($values);
        }
        
        if (array_key_exists('active', $values))
        {
            $this->setActive($values);
        }
        
        return $this;
    }

    public function reset() {
        $this->SetEmailType('');
        $this->setActive('');
    }
    

}

