<?php $this->load->view('partial/header_page.php'); ?>
<div id="wrapper" class="wat-cf"><!--start of the main wrappers-->
      <div id="main">
 
        
                  
 <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
           <?php echo $access_uri;?>
          </div>
          <div class="content">
            <h2 class="title">New Employee</h2>
            <?php if(strlen($error) > 0){ ?>
             <div class="flash">
        <div class="message error">
            <p><?php echo $error;?></p>
         </div>
         </div>
        <?php };?>
            <div class="inner">
               <?php echo form_open('employees/add_employee', 'class="form"') ; ?> 
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">FirstName</label>
                     <?php echo form_input('first_name', set_value('first_name'), 'class="text_field"') ; ?> 
                    </div>
                    <div class="group">
                      <label class="label">LastName</label>
                      <?php echo form_input('last_name', set_value('last_name'), 'class="text_field"') ; ?> 
                    </div>
                     <div class="group">
                      <label class="label">Date Of Birth</label>
                      <input type = "text" name = 'pickupdate' class ="datepicker" />
                      <!--<script>DateInput('pickupdate', true, 'DD-MON-YYYY')</script>-->
                    </div>
                     <div class="group">
                      <label class="label">Email</label>
                      <?php echo form_input('email', set_value('email'), 'class="text_field"') ; ?> 
                    </div>
                    <div class="group">
                      <label class="label">Phone Number</label>
                      <?php echo form_input('phone_number', set_value('phone_number'), 'class="text_field"') ; ?> 
                    </div>
                    <div class="group">
                      <label class="label">Contact Address</label>
                      <textarea name= "contact_address" class="text_area" rows="10" cols="80"></textarea>
                    </div>
                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">Department</label>
                      <select name = "department">
                      <?php echo '<option value = "">Select Department name</option>';
          							?>
                              <?php foreach($department as $row){
                              			$department_id = $row['department_id'];
                              			$department_name = $row['department_name'];
                              			
                              			echo '<option value = '.$department_id.'>'.$department_name.'</option>';
                              }?>
                      </select>
                    </div>
                     <div class="group">
                      <label class="label">Position</label>
                      <?php echo form_input('position', set_value('position'), 'class="text_field"') ; ?> 
                    </div>
                    <div class="group">
                      <label class="label">Contract Type</label>
                      <div>
                        <input type="radio" name="contract_type" id="radio_1" class="checkbox" value="full-time" /> <label for="radio_1" class="radio">Permanent</label>
                      </div>
                      <div>
                        <input type="radio" name="contract_type" id="radio_2" class="checkbox" value="part-time" /> <label for="radio_2" class="radio">Temporary</label>
                      </div>
                    </div> 
                    <div class="group">
                      <label class="label">End Of Contract</label>
                      <input type = "text" name = 'contractdate' class ="datepicker" id = "date_1" />
                      <!--<script>DateInput('pickupdate', true, 'DD-MON-YYYY')</script>-->
                    </div>
                    <!--<div class="group">
                      <label class="label">Benefits</label>
                      <div>
                        <input type="checkbox" name="checkbox" id="checkbox_1" class="checkbox" value="1" /> <label for="checkbox_1" class="checkbox">Option 1</label>
                      </div>
                      <div>
                        <input type="checkbox" name="checkbox" id="checkbox_2" class="checkbox" value="2" /> <label for="checkbox_2" class="checkbox">Option 2</label>
                      </div>
                    </div>
                    <div class="group">
                      <label class="label">Radio</label>
                      <div>
                        <input type="radio" name="radio" id="radio_1" class="checkbox" value="1" /> <label for="radio_1" class="radio">Option 1</label>
                      </div>
                      <div>
                        <input type="radio" name="radio" id="radio_2" class="checkbox" value="2" /> <label for="radio_2" class="radio">Option 2</label>
                      </div>
                    </div>-->
                  </div>
                </div>
                <div>
                 <input type="submit" name = "submit" value = "Save"/>
                 <input type="reset" name = "reset" value = "Cancel"/>
                </div>
              <?php echo form_close();?>
            </div>
          </div>
        </div>
           <?php $this->load->view('partial/footer_page.php'); ?>