<?php
namespace asoto\week2;

class EmailsModel implements IModel
{
    
    private $emailid;
    private $email;
    private $emailtypeid;
    private $emailtype;
    private $emailtypeactive;
    private $logged;
    private $lastupdate;
    private $active;
    
    
    function getEmailId()
    {
        return $this->emailid;
    }
    
    function setEmailId($emailid)
    {
        $this->emailid = $emailid;
    }
    
    
    function getEmail()
    {
        return $this->email;
    }
    
    function setEmail($email)
    {
        $this->email = $email;
    }
    
    function getEmailTypeId()
    {
        return $this->emailtypeid;
    }
    
    function setEmailTypeId($emailtypeId)
    {
        $this->emailtypeid = $emailtypeId;
    }
    
    function getEmailType()
    {
        return $this->emailtype;
    }
    
    function setEmailType($emailtype)
    {
        $this->emailtype = $emailtype;
    }
    
    function getEmailTypeActive()
    {
        return $this->emailtypeactive;
    }
    
    function setEmailTypeActive($emailtypeactive)
    {
        $this->emailtypeactive = $emailtypeactive;
    }
    
    function getLogged()
    {
        return $this->logged;
    }
    
    function setLogged($logged)
    {
        $this->logged = $logged;
    }
    
    function getLastUpdate()
    {
        return $this->lastupdate;
    }
    
    function setLastUpdate($lastupdate)
    {
        $this->lastupdate = $lastupdate;
    }
    
    function getActive()
    {
        return $this->active;
    }
    
    function setActive($active)
    {
        $this->active = $active;
    }
    
    
    
    public function map(array $values) {
        if ( array_key_exists('emailid', $values) ) { 
             $this->setEmailId($values['emailid']); 
         } 
          
         if ( array_key_exists('email', $values) ) { 
             $this->setEmail($values['email']); 
         } 
          
         if ( array_key_exists('emailtypeid', $values) ) { 
             $this->setEmailTypeId($values['emailtypeid']); 
         } 
          
         if ( array_key_exists('emailtype', $values) ) { 
             $this->setEmailType($values['emailtype']); 
         } 
          
         if ( array_key_exists('emailtypeactive', $values) ) { 
             $this->setEmailTypeActive($values['emailtypeactive']); 
         } 
          
         if ( array_key_exists('logged', $values) ) { 
             $this->setLogged($values['logged']); 
         } 
          
         if ( array_key_exists('lastupdated', $values) ) { 
             $this->setLastUpdate($values['lastupdated']); 
         } 
          
         if ( array_key_exists('active', $values) ) { 
             $this->setActive($values['active']); 
         } 
         return $this; 
    }


    public function reset() {
        
        $this->setEmailid(''); 
        $this->setEmail(''); 
        $this->setEmailtypeid(''); 
        $this->setEmailtype(''); 
        $this->setEmailtypeactive(''); 
        $this->setLogged(''); 
        $this->setLastUpdate('');
        $this->setActive(''); 
        return $this; 

    }

}

