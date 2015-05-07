
                <table class="table" border="1">
                  
                  <tr>
                    
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    </tr>
                 
                  
                  
                  
                    
                 
                 <?php foreach($query as $row){
                          $first_name = $row['first_name'];
                          $last_name = $row['last_name'];
                          $email = $row['email'];
                          $phone_number = $row['phone_number'];
                          $contract_type = $row['contract_type'];
                          $employee_id = $row['employee_id'];
                          
                   echo '<tr class="odd">
                        <td>'.ucfirst($first_name).' '.ucfirst($last_name).'</td>
                        <td>'.$email.'</td>
                        <td>'.$phone_number.'</td>
                        <td>'.$contract_type.'</td>
                        
                  </tr>';
                 }
                  ?>
                
                
                </table>