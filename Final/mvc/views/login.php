<?php include('Style.html'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
          
            var_dump($scope->util->isLoggedin());
        
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
            
            Email : <input type="email" name="email" value="" /> <br />
            Password : <input type="password" name="password" value="" /> <br /> 
            <br />
            <input type="submit" value="Signup" />
            
        </form>
    </body>
</html>
