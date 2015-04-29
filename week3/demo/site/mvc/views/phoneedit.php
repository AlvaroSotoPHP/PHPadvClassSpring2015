<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        
         if ( isset($scope->view['updated']) ) {
            if( $scope->view['updated'] ) {        
                 echo 'Phone Updated';
            } else {
                 echo 'Phone NOT Updated';
            }                 
        }
        
            $emailid = $scope->view['model']->getPhoneid();
            $email = $scope->view['model']->getPhone();
            $active = $scope->view['model']->getActive();
            $emailTypeid = $scope->view['model']->getPhonetypeid();
        ?>
        
        <h3>Add email</h3>
        <form action="#" method="post">
            <label>Phone:</label>            
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <label>Phone Type:</label>
            <select name="emailtypeid">
            <?php 
                foreach ($scope->view['emailTypes'] as $value) {
                    if ( $value->getPhonetypeid() == $emailTypeid ) {
                        echo '<option value="',$value->getPhonetypeid(),'" selected="selected">',$value->getPhonetype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getPhonetypeid(),'">',$value->getPhonetype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
             <input type="hidden"  name="emailid" value="<?php echo $emailid; ?>" />
            <input type="hidden" name="action" value="update" />
            <input type="submit" value="Submit" />
        </form>
        
        
        
         <br />
         <br />
         
        <form action="#" method="post">
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="ADD Page" /> 
        </form>
        
         <?php 
         
          if ( count($scope->view['emails']) <= 0 ) {
                echo '<p>No Data</p>';
            } else {
                echo '<table border="1" cellpadding="5"><tr><th>Phone</th><th>Phone Type</th><th>Last updated</th><th>Logged</th><th>Active</th><th></th><th></th></tr>'; 
                 foreach ($scope->view['emails'] as $value) {
                    echo '<tr><td>',$value->getPhone(),'</td><td>',$value->getPhonetype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                    echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                     echo '<td><form action="#" method="post"><input type="hidden"  name="emailid" value="',$value->getPhoneid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="emailid" value="',$value->getPhoneid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
               
                    echo '</tr>' ;
                }
                echo '</table>';
            }
           
           

         ?>
            
    </body>
</html>
