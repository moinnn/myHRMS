 <?php  $this->load->view('partial/header_page.php');?>
<body>

    
     <div id="wrapper" class="wat-cf"><!--start of the main wrappers-->
      <div id="main">
        
        
        <div class="block" id="block-text">
          <div class="secondary-navigation">
            <?php echo $access_uri;?>
          </div>
          
           <div class="content">
            <h2 class="title">Employees List</h2>
           
                     
            <div class="inner">
              <!--form tag attached here-->
                 <div class="group">
                  <?php echo form_open('employees/search_employee'); ?>
                      <label class="label">Search Employee</label>
                      <input type="text" name="search" class="text_field" /> <input type="submit"  name = "submit" value = "Search"/>
                      <br/><br/>
                      <?php echo form_close();?>
                    </div>
                 <!--form tag ends here-->
             
                <table class="table">
                  <thead>
                  <tr>
                    
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th class="last">&nbsp;</th>
                     <?php echo $result;?>
                  </tr>
                  
                  </thead>
                  <tbody>
                  
                  
                 
                 <?php
                 //echo $res;
               
                  foreach($query as $row){
                          $first_name = $row['first_name'];
                          $last_name = $row['last_name'];
                          $email = $row['email'];
                          $phone_number = $row['phone_number'];
                          $contract_type = $row['contract_type'];
                          $employee_id = $row['employee_id'];
                          $department_id = $row['position'];
                          $position = $row['position'];
                          
                   echo '<tr class="odd">
                        <td>'.ucfirst($first_name).' '.ucfirst($last_name).'</td>
                        <td>'.$email.'</td>
                        <td>'.$department_id.'</td>
                        <td>'.ucfirst($contract_type).'</td>
                        <td class="last"><a href="'.site_url('employees/view_employee/'.$employee_id).'"><img class = "avatar" height = "20" width = "20" src="'.base_url().'assets/images/show.png" alt="Show Employee" /></a>  <a href="'.site_url('employees/edit_employee/'.$employee_id).'"><img class = "avatar" height = "20" width = "20" src="'.base_url().'assets/images/edit.ico" alt="Show Employee" /></a>  <a href="'.site_url('employees/delete_employee/'.$employee_id).'"><img class = "avatar" height = "20" width = "20" src="'.base_url().'assets/images/delete.png" alt="Show Employee" /></a></td>
                  </tr>';
                 }
                
                  
                  ?>
                               
                  </tbody>
                </table>
                 
                  <div class="pagination">
                    
                        <?php echo "<a href =".site_url('employees/index')." >$pagination</a>";?>
                     
                  </div>
               
            </div>
          </div>
        </div>
         <?php $this->load->view('partial/footer_page.php'); ?>
 <!--<span class="disabled prev_page">� Previous</span><span>1</span><a rel="next" href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a><a rel="next" class="next_page" href="#">Next �</a>-->