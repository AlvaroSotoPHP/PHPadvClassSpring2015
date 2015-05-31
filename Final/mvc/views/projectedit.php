<?php include('Style.html'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        <?php
        // put your code here
        
        
         if ( isset($scope->view['updated']) ) {
            if( $scope->view['updated'] ) {        
                 echo 'Project Updated';
            } else {
                 echo 'Project NOT Updated';
            }                 
        }
        
            $projectid = $scope->view['model']->getProjectid();
            $project = $scope->view['model']->getProject();
            $active = $scope->view['model']->getActive();
            $projectTypeid = $scope->view['model']->getProjecttypeid();
        ?>
        
        <h1 align="center">Edit Project</h1>
        <form action="#" method="post" style="text-align: center;">
            <label>Project:</label>            
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
             <input type="hidden"  name="projectid" value="<?php echo $projectid; ?>" />
            <input type="hidden" name="action" value="update" />
            <input type="submit" value="Submit" />
        </form>
        
        
        
         <br />
         <br />
         <div align="center">
         <?php 
         
          if ( count($scope->view['projects']) <= 0 ) {
                echo '<p>No Data</p>';
            } else {
                echo '<table border="1" class="gridtable" cellpadding="5" align="center"><tr><th>Project</th><th>Project Type</th><th>Last updated</th><th>Logged</th><th>Active</th><th></th><th></th></tr>'; 
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
            <input type="hidden" name="action" value="logout" />
            <input type="submit" value="Logout" style="float: right; bottom: 0px;"/> 
        </form>
            
    </body>
</html>
