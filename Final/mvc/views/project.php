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
        /*if(!$scope->util->isLoggedin())
            {
                $scope->util->redirect('login');
            }*/
        
         if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
                print_r($scope->view['errors']);
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Project Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Project deleted';
             }
             
         }
        
            $project = $scope->view['model']->getProject();
            $active = $scope->view['model']->getActive();
            $projectTypeid = $scope->view['model']->getProjecttypeid();
        ?>
        
        <h1 align="center">Add a Project</h1>
        <form action="#" method="post" >
            <div style="text-align: center;">
            <label>Project Name:</label>            
            <input type="text" name="project" value="<?php echo $project; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <label>Project Type:</label>
            <select name="projecttypeid">
            <?php 
                foreach ($scope->view['projectTypes'] as $value) {
                    if ( $value->getProjecttypeid() == $projectTypeid ) {
                        echo '<option value="',$value->getProjecttypeid(),'" selected="selected">',$value->getProjecttype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getProjecttypeid(),'">',$value->getProjecttype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="hidden" name="action" value="create" />
            <input type="submit" value="Submit" />
            </div>
        </form>
        
        
        
         <br />
         <br />
        
         <div style="text-align: center;">
         <?php 
         
          if ( count($scope->view['projects']) <= 0 ) {
                echo '<p>No Data</p>';
            } else {
                echo '<table border="1" cellpadding="5" align="center"><tr><th>Project</th><th>Project Type</th><th>Last updated</th><th>Logged</th><th>Active</th><th></th><th></th></tr>'; 
                 foreach ($scope->view['projects'] as $value) {
                    echo '<tr><td>',$value->getProject(),'</td><td>',$value->getProjecttype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                    echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                     echo '<td><form action="#" method="post"><input type="hidden"  name="projectid" value="',$value->getProjectid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="projectid" value="',$value->getProjectid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
               
                    echo '</tr>' ;
                }
                echo '</table>';
            }
           
           

         ?>
         </div>
         
        <form action="#" method="post">
            <div style="float:right; bottom:0px; ">
            <input type="hidden" name="action" value="logout" />
            <input type="submit" value="Logout" />
            </div>
        </form>
            
    </body>
</html>
