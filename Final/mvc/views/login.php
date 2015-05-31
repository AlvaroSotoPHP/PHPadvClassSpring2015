<?php include('Style2.html'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <?php
          
            if ( $scope->util->isPostRequest() ) {

                $model = $this->service->getModel();
                $LoginDao = $this->service->getDAO();

                $model->map(filter_input_array(INPUT_POST));
                                
                if ( $LoginDao->login($model) ) {
                    echo '<h2>Login Sucess</h2>';
                    $scope->util->setLoggedin(true);
                    $scope->util->redirect('index');
                } else {
                    echo '<h2>Login Failed</h2>';
                }
            }
        ?>
        
        <h1>Login</h1>
        <form action="#" method="POST">
            <table style="left: 210px; position: absolute;">
                <tbody>
                    <tr>
                        <td>Email :</td><td><input type="email" name="email" value="" /> <br /></td>
                    </tr>
                    <tr>
                        <td>Password :</td><td><input type="password" name="password" value="" /> <br /></td> 
                    </tr>
                    <tr>
                        <td><input type="submit" value="Signup" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </body>
</html>
