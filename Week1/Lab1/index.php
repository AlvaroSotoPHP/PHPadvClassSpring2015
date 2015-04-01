<?php include './bootstrap.php'; ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //Getting variable
        $emailtype = filter_input(INPUT_POST, 'emailtype');
        
        //instantiating classes
        $util = new Util();
        $validator = new Validator();
        
        //Setting array for errors
        $errors = array();
        
        //Setting up the config for the database
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
            );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        //Using classes
        if ($util->isPostRequest())
        {
            //Validate only if post has been made
            if (!$validator->emailTypeIsValid($emailtype))
            {
                $errors[] = 'Email type is not valid';
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
            //if no errors, save to the database
            $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");
            
            $values = array(":emailtype"=>$emailtype);
            
            if ($stmt->execute($values) && $stmt->rowCount() > 0)
            {
                echo 'Email Type Added';
            }
        }
        
    }
        
        ?>
        
        <h3>Add Email Type</h3>
        <form action="#" method="post">
            <label>Email Type:</label>
            <input type="text" name="emailtype" value="<?php echo $emailtype; ?>" />
            <input type="submit" value="Submit" />
        </form>
        
        
        <?php
        
        //Display values from database
        $stmt = $db->prepare("SELECT * FROM emailtype");
        
        if ($stmt->execute() && $stmt->rowCount() > 0)
        {
            //fetchAll gets al the values and fetch gets one row
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            //Results are return as a assoc array
            foreach($results as $value)
            {
                echo '<p><ol>', $value['emailtype'], '</ol></p>';
            }
        }
        else
        {
            echo '<p>No Data</p>';
        }
        
        ?>
        
    </body>
</html>
