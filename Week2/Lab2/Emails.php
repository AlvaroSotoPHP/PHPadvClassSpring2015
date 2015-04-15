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
    
    $email = filter_input(INPUT_POST, 'email');
    $emailTypeId = filter_input(INPUT_POST, 'emailtypeid');
    $active = filter_input(INPUT_POST, 'active');
    
    $emailTypeDAO = new EmailTypeDAO($db);
    $emailDAO = new EmailsDAO($db);
    
    $emailTypes = $emailTypeDAO->getAllRows();
    
    $util = new Util();
    
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
                        echo 'Email Added';
                        $email = '';
                        $emailTypeId = '';
                        $active = '';
                    } else {
                        echo 'Email not added';
                    }
                    
                }
                
                $test = filter_input(INPUT_POST, 'emailtypeid');
                
                echo $test;
            ?>

        <h3>Add Email</h3>
        <form action="#" method="post">
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
            <input type="submit" value="Submit" />
        </form>
        
        <br />
        <br />
        
        <table border="1" cellpadding="5">
            <tr>
                <th>Email</th>
                <th>Email Type</th>
                <th>Last updated</th>
                <th>Logged</th>
                <th>Active</th>
            </tr>
            
            <?php
            
            $emails = $emailDAO->getAllRows();
            foreach($emails as $value)
            {
                echo'<tr><td>', $value->getEmail(), '</td><td>', $value->getEmailType(), '</td><td>', date("F j, Y g:i(s) a", strtotime($value->getLastUpdate())),'</td><td>', date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo '<td>', ($value->getActive() == 1 ? 'Yes' : 'No'), '</td>';
                echo '<td><a href=options.php?emailid=', $value->getEmailId(), '>Options</a></td>';
            }
            
            ?>
        </table>



