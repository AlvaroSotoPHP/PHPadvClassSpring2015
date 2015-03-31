<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        $phonetype = filter_input(INPUT_POST, 'phonetype');
        
        if (!empty($_POST))
        {
            if (!empty($phonetype))
            {
                echo 'Phone type is valid.';
            }
            else
            {
                echo 'Phone type is empty.';
            }
        }
        ?>
        
        <h3>Add Phone Type</h3>
        <form action="#" method="post">
            <label>Phone Type:</label>
            <input type="text" name="phonetype" value="<?php echo $phonetype; ?>" />
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
