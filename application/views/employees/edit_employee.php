<?php $this->load->view('partial/header_page.php'); ?>
<div id="wrapper" class="wat-cf"><!--start of the main wrappers-->
      <div id="main">
 
        
                  
 <div class="block" id="block-forms-2">
          <div class="secondary-navigation">
           <?php echo $access_uri;?>
          </div>
          <div class="content">
            <h2 class="title">Edit Employee - <?php echo $first_name.' '.$last_name; ?> </h2>
            <?php if(strlen($error) > 0){ ?>
             <div class="flash">
        <div class="message error">
            <p><?php echo $error;?></p>
         </div>
        <?php };?>
            <div class="inner">
               <?php echo form_open('employees/edit_employee/'.$id, 'class="form"') ; ?> 
                <div class="columns wat-cf">
                  <div class="column left">
                    <div class="group">
                      <label class="label">FirstName</label>
                      <input type="text" name="fname" class="text_field" value="<?php echo $fname;?>"/>
                     
                    </div>
                    <div class="group">
                      <label class="label">LastName</label>
                      <input type="text" name="lname" class="text_field" value="<?php echo $lname;?>"/>
                    </div>
                    
                    <div class="group">
                      <label class="label">Phone Number</label>
                      <input type="text" name="fone" class="text_field" value="<?php echo $fone;?>"/>
                    </div>
                    <div class="group">
                      <label class="label">Contact Address</label>
                      <textarea name= "contact_address" class="text_area" rows="10" cols="80"><?php echo $address; ?></textarea>
                    </div>
                  </div>
                  <div class="column right">
                    <div class="group">
                      <label class="label">Department</label>
                      <select name = "department">
                              <option value="1">Choose...</option>
                      </select>
                    </div>
                     <div class="group">
                      <label class="label">Position</label>
                      <input type="text" name="position" class="text_field" value="<?php echo $position;?>"/>
                    </div>
                     <div class="group">
                      <label class="label">Contract Type</label>
                      <select name = "contract_type">
                              <option value="1">Choose...</option>
                      </select>
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
                 <input type="submit" name = "submit" value = "Edit Changes"/>
                 <input type="reset" name = "reset" value = "Cancel"/>
                </div>
              <?php echo form_close();?>
            </div>
          </div>
        </div>
           <?php $this->load->view('partial/footer_page.php'); ?>