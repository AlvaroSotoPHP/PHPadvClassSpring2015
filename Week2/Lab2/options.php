<!DOCTYPE html>
<?php include './bootstrap.php' ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

<?php

    $dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
    );
    
    $pdo = new DB($dbConfig);
    $db =  $pdo->getDB();
    
    $emailTypeDAO = new EmailTypeDAO($db);
    $emailDAO = new EmailsDAO($db);
    $emailTypes = $emailTypeDAO->getAllRows();
    
    $emailid = filter_input(INPUT_GET, 'emailid');
    
    $info = $emailDAO->getById($emailid);
    $emailGet = $info->getEmail();
    $emailTypeIdGet = $info->getEmailTypeId();
    $activeGet = $info->getActive();
    
    $email = filter_input(INPUT_POST, 'email');
    $emailTypeId = filter_input(INPUT_POST, 'emailtypeid');
    $active = filter_input(INPUT_POST, 'active');
    
    $util = new Util();
    
    $option = filter_input(INPUT_POST, 'Option');
    
    if ($option == 'Update')
    {
    $validator = new Validator(); 
                $errors = array();
                if( !$validator->emailIsValid($email) ) {
                    $errors[] = 'Email is invalid';
                } 
                
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }
                 
                if ( empty($emailTypeId) ) {
                     $errors[] = 'Email type is invalid';
                }
                
               if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                    }
                } else {
                    
                    
                    $emailModel = new EmailsModel();
                    
                    $emailModel->map(filter_input_array(INPUT_POST));
                  
                    if ( $emailDAO->save($emailModel) ) {
                        echo 'Email Updated';
                        $email = '';
                        $emailTypeId = '';
                        $active = '';
                        $emailid = '';
                    } else {
                        echo 'Email was not Updated';
                    }
                    
                }
                
                $option = '';
    }
    else if ($option == 'Delete')
    {
        if ( NULL !== $emailid ) 
            {
               
               if ( $emailDAO->delete($emailid) ) {
                   echo 'Email was deleted';                  
               }   
               
              else{
                  
                  echo 'Email was not delete';
                  
              }
            }
            
            $option = '';
    
    }
    else
    {
        
    $email = $emailGet;
    $emailTypeId = $emailTypeIdGet;
    $active = $activeGet;
    
    }
            ?>

        
        <h3>Email Options</h3>
        <form action="#" method="post">
            <label>Email ID</label>
            <input type="text" name="emailid" value="<?php echo $emailid; ?>" />
            <br />
            <br />
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br />
            <br />
            <label>Email Type</label>
            <select name="emailtypeid">
                <?php
                echo var_dump($emailTypeId);
                foreach ($emailTypes as $value)
                {
                    if ($value->getEmailTypeId() == $emailTypeId)
                    {
                        echo '<option value="', $value->getEmailTypeId(),'" selected="selected">', $value->getEmailType(), '</option>';
                    }
                    else
                    {
                        echo '<option value="', $value->getEmailTypeId(),'">' ,$value->getEmailType(), '</option>';
                    }
                }
                
                ?>
            </select>
            <br />
            <br />
            <label>Active</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            <br />
            <br />
            <input type="submit" name="Option" value="Update" />
            <input type="submit" name="Option" value="Delete" />
        </form>
        
        <br />
        <br />
        
        <a href="Emails.php">Go Back</a>
       

