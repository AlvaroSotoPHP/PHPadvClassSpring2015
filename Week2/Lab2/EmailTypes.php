<?php 
namespace asoto\week2;
include './bootstrap.php' 
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
<?php

$dbConfig = array(
    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvclassspring2015',
    "DB_USER"=>'root',
    "DB_PASSWORD"=>''
    );

$pdo = new DB($dbConfig);
$db = $pdo->getDB();

$emailType = filter_input(INPUT_POST, 'emailtype');
$active = filter_input(INPUT_POST, 'active');

$emailTypeDAO = new EmailTypeDAO($db);

$util = new Util();

if ( $util->isPostRequest() ) {
                            
               $validator = new Validator(); 
               $errors = array();
               //!$validator->activeIsValid($active)
               if (!$validator->activeIsValid($active))
               {
                   $errors[] = "Active is invalid";
               }
               
               if (!$validator->emailTypeIsValid($emailType))
               {
                   $errors[] = 'Email type is invalid.';
               }
               
               if (count($errors) > 0)
               {
                   foreach ($errors as $value)
                   {
                       echo '<p>',$value,'</p>';
                   }
               }
               else
               {
                   $emailTypeModel = new EmailTypeModel();
                   $emailTypeModel->map(filter_input_array(INPUT_POST));
                   
                   
                   
                   if ($emailTypeDAO->save($emailTypeModel))
                   {
                       echo 'Email Type Added';
                   }
                   else
                   {
                       echo 'Email Type not Added';
                   }
               }
}
?>
    <body>
        <h3>Add Email Type</h3>
        <form action="#" method="post">
            <label>Phone Type</label>
            <input type="text" name="emailtype" value="<?php $emailType; ?>" placeholder="" />
            <br />
            <br />
            <label>Active</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br />
            <br />
            
            <input type="submit" value="Submit" />
            
            <br />
            <br />
            <table border="1" cellpadding="5">
                <tr>
                    <th>Type</th>
                    <th>Options</th>
                </tr>
                
            <?php
            
                $emails = $emailTypeDAO->getAllRows();
            
                foreach ($emails as $value)
                {
                    echo '<tr><td>',$value->getEmailType(), ' - ', $value->getActive() == 1 ? 'Yes' : 'No', '</td>';
                    echo '<td><a href=options2.php?emailtypeid=', $value->getEmailTypeId(), '>Options</a></td>';
                }
                ?>
                
            </table>
    </body>
            
        </form>
                







