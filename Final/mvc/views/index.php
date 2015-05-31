<?php include('Style.html'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div style="text-align: center;">
            <?php 
                var_dump($scope->util->isLoggedin());
            ?>
            <h1>Welcome to the Project Tracker!</h1>
            <hr />
        </div>
    </body>
</html>
