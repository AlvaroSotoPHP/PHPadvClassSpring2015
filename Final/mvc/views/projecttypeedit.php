<?php include('Style.html'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
            
        
        if ( isset($scope->view['updated']) ) {
            if( $scope->view['updated'] ) {        
                 echo 'Project Updated';
            } else {
                 echo 'Project NOT Updated';
            }                 
        }
        
         $projectType = $scope->view['model']->getProjecttype();
         $active = $scope->view['model']->getActive();
         $projecttypeid = $scope->view['model']->getProjecttypeid();
        ?>
        
        
         <h1 align="center">Edit Project type</h1>
        <form action="#" method="post" style="text-align: center;">
            <label>Project Type:</label> 
            <input type="text" name="projecttype" value="<?php echo $projectType; ?>" placeholder="" />
            <input type="number" max="1" min="0" name="Active" value="<?php echo $active; ?>" />
            <input type="hidden"  name="projecttypeid" value="<?php echo $projecttypeid; ?>" />
            <input type="hidden" name="action" value="update" />
            <input type="submit" value="Submit" />
        </form>
         
         <br />
         <br />
         
         <div>
         <?php
         
         if ( count($scope->view['ProjectTypes']) <= 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5" align="center"><tr><th>Project Type</th><th>Active</th><th></th><th></th></tr>';
             foreach ($scope->view['ProjectTypes'] as $value) {
                echo '<tr>';
                echo '<td>', $value->getProjecttype(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="projecttypeid" value="',$value->getProjecttypeid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="projecttypeid" value="',$value->getProjecttypeid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
         
         
         ?>
    </div>
         
        <form action="#" method="post">
            <input type="hidden" name="action" value="logout" />
            <input type="submit" value="Logout" style="float: right; bottom: 0px;"/> 
        </form>
         
    </body>
</html>
