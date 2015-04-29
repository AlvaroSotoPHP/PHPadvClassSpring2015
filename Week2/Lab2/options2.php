<?php 
namespace asoto\week2;
include './bootstrap.php' 

?>

<!DOCTYPE html>
<!--
Updates Email type based on the id pulled from the selected type.
-->
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
        $db = $pdo->getDB();
        
       
        
        $util = new Util();
        $emailTypeDAO = new EmailTypeDAO($db);
        $validator = new Validator();
        $emailTypeModel = new EmailTypeModel();
        $errors = array();
        
        if ( $util->isPostRequest() ) 
        {
            
            $emailTypeModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $emailTypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailTypeModel = $emailTypeDAO->getById($emailTypeid);
        
        }
        
     
        
        $emailTypeid = $emailTypeModel->getEmailtypeId();
        $emailType = $emailTypeModel->getEmailtype();
        $active = $emailTypeModel->getActive(); 
        
        
        if ($util->isPostRequest())
        {
            $emailTypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailTypeModel = $emailTypeDAO->getById($emailTypeid);
            
            $emailType = filter_input(INPUT_POST, 'emailtype');
            $active = filter_input(INPUT_POST, 'active');
        
            if(!$validator->emailTypeIsValid($emailType))
            {
                $errors[] = 'Email Type is invalid';
            }
            
            if(!$validator->activeIsValid($active))
            {
                $errors[] = 'Active is invalid';
            }
            
            if(count($errors) > 0 )
            {
                foreach ($errors as $value)
                {
                  
                    echo'<p>',$value,'</p>';
                }
            }
            else 
            {          
                $option = filter_input(INPUT_POST, 'Option');     
                //echo $option;
                if ($option == 'Update')
                {
                       if($emailTypeDAO->idExisit($emailTypeModel->getEmailtypeId()))
                       {
                           $emailTypeModel->setActive($active);
                           $emailTypeModel->setEmailtype($emailType);
                            
                           if($emailTypeDAO->save($emailTypeModel)){
                            
                                echo "Email Type Updated.";
                                $emailType = '';
                                $active = '';
                           }
                            
                            
                            
                        }
                }
                else if ($option == 'Delete')
                {
                    if($emailTypeDAO->idExisit($emailTypeModel->getEmailtypeid()))
                       {
                           $emailTypeModel->setActive($active);
                           $emailTypeModel->setEmailtype($emailType);
                            
                           if($emailTypeDAO->delete($emailTypeid)){
                            
                                echo "Email Type Deleted.";
                                $emailType = '';
                                $active = '';
                           }
                                
                            
                        }
                }
            }
       }
        
        
       ?>
        <h3>Email Type Options</h3>
        <form action="#" method="post">
            <label>Email Type:</label>
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            
            
            <br /><br />
            <input type="submit" name="Option" value="Update" />
            <input type="submit" name="Option" value="Delete" />
        </form>
        
        <?php
        echo '<p><a href="EmailTypes.php">Back to Previous Page</a></p>';
        ?>
    </body>
</html>