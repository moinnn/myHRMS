<?php $this->load->view('partial/header_page.php'); ?>
<div id="wrapper" class="wat-cf"><!--start of the main wrappers-->
      <div id="main">
      
      <div class="block" id="block-forms">
          <div class="secondary-navigation">
           <?php echo $access_uri;?>
          </div>
          <div class="content">
            <h2 class="title">Add Benefit - <?php echo $employee_name;?></h2>
            <?php if(strlen($error) > 0){ ?>
             <div class="flash">
        <div class="message error">
            <p><?php echo $error;?></p>
         </div>
         </div>
        <?php };?>
            <div class="inner">
               <?php echo form_open('benefit/add_benefit/'.$id, 'class="form"') ; ?> 
                <div class="group">
                  <label class="label">Benefit Type</label>
                  <?php echo $benefit;?>
                  <!--<span class="description">Ex: a simple text</span>-->
                </div>
                
                <div class="group">
                    <label class="label" for="post_title">Entities</label>
                     
                     <select name = "entities">
                        
                              <option value="">Select Entites Here</option>
                              <option value="E">Employer Only</option>
                              <option value="ES">Employer and Spouse</option>
                              <option value="EF">Employer and Family</option>
                        </select>                 
                </div>
                
                <div class="group">
                      <label class="label">Commencement Date</label>
                      <input type = "text" name ="start_date" class = "datepicker" />
                     
                    </div>
                
                <div class="group">
                      <label class="label">Expiry Date</label>
                      <input type = "text" name ="end_date" class = "datepicker" />
                      
                    </div>
                
                  
                
                <div class="group">
                  <label class="label">Comment</label>
                  <textarea name= "comment" class="text_area" rows="10" cols=""></textarea>
                  <span class="description"></span>
                </div>
                <div class="group navform wat-cf">
                   <input type="submit"  name = "submit" value = "Save"/>
                 <input type="reset" name = "reset" value = "Cancel"/>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
       <?php $this->load->view('partial/footer_page.php'); ?>