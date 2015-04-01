<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        $emailtype = filter_input(INPUT_POST, 'emailtype');
        
        if (!empty($_POST))
        {
            if (!empty($emailtype))
            {
                echo 'Email type is valid.';
            }
            else
            {
                echo 'Email type is empty.';
            }
        }
        ?>
        
        <h3>Add Email Type</h3>
        <form action="#" method="post">
            <label>Email Type:</label>
            <input type="text" name="phonetype" value="<?php echo $emailtype; ?>" />
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
