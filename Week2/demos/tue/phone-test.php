<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
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
        
        
        $email = filter_input(INPUT_POST, 'email');
        $emailTypeid = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');
        
        
         $emailTypeDAO = new PhoneTypeDAO($db);
         $emailDAO = new PhoneDAO($db);
         
         $emailTypes = $emailTypeDAO->getAllRows();
        
         $util = new Util();
         
          if ( $util->isPostRequest() ) {
                            
               $validator = new Validator(); 
                $errors = array();
                if( !$validator->emailIsValid($email) ) {
                    $errors[] = 'Phone is invalid';
                } 
                
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }
                
                if ( empty($emailTypeid) ) {
                     $errors[] = 'Phone type is invalid';
                }
                
                
                
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                    }
                } else {
                    
                    
                    $emailModel = new PhoneModel();
                    
                    $emailModel->map(filter_input_array(INPUT_POST));
                    
                   // var_dump($emailtypeModel);
                    if ( $emailDAO->save($emailModel) ) {
                        echo 'Phone Added';
                    } else {
                        echo 'Phone not added';
                    }
                    
                }
          }
        
        ?>
        
        
         <h3>Add email</h3>
        <form action="#" method="post">
            <label>Phone:</label>            
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <label>Phone Type:</label>
            <select name="emailtypeid">
            <?php 
                foreach ($emailTypes as $value) {
                    if ( $value->getPhonetypeid() == $emailTypeid ) {
                        echo '<option value="',$value->getPhonetypeid(),'" selected="selected">',$value->getPhonetype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getPhonetypeid(),'">',$value->getPhonetype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
            <table border="1" cellpadding="5">
                <tr>
                    <th>Phone</th>
                    <th>Phone Type</th>
                    <th>Last updated</th>
                    <th>Logged</th>
                    <th>Active</th>
                </tr>
         <?php 
            $emails = $emailDAO->getAllRows(); 
            foreach ($emails as $value) {
                echo '<tr><td>',$value->getPhone(),'</td><td>',$value->getPhonetype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td></tr>' ;
            }

         ?>
            </table>
    </body>
</html>
