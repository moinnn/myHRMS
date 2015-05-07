<?php $this->load->view('partial/header_page.php'); ?>
<div id="wrapper" class="wat-cf"><!--start of the main wrappers-->
      <div id="main">
 
         <div class="block" id="block-lists">
                  <?php echo $access_uri;?>
          
          <div class="content">
            <h2 class="title">Employee Profile - <?php echo $employee_name;?></h2>
            <div class="inner">
              <ul class="list">
                <li>
                  <div class="left">
                    <a href="<?php echo site_url('employees');?>"><img class="avatar" src="<?php echo base_url(); ?>assets/images/employeeicon.bmp" alt="avatar" /></a>
                  </div>
                  
                  <div class="item">
                           <h3>Contact Details</h3>
                           <ul class = "list">
                                    <li><b>Email Address</b> - <?php echo $email;?></li>
                                    <li><b>Phone Number</b> - <?php echo $phone;?></li>
                                    <li><b>Address</b> - <?php echo $address;?></li>
                           
                           <li><a href = "<?php echo site_url('employees/edit_employee/'.$id);?>" STYLE = "text-decoration: none">Edit Details</a></li>
                    </ul>
                    
                  </div>
                </li>
                <li>
                  <div class="left">
                    <a href="<?php echo site_url('leave'); ?>"><img class="avatar" src="<?php echo base_url(); ?>assets/images/leave.jpeg" alt="avatar" /></a>
                  </div>
                  
                  <div class="item">
                           <h3>Job Details</h3>
                    <ul class = "list">
                           <li><b>Department</b> - <?php echo $department;?></li>
                           <li><b>Position</b> - <?php echo $position;?></li>
                           <li><b>Status</b><?php echo $status;?></li>
                           <li><b>Resumption Date</b> - <?php echo $resumption;?></li>
                           <li><a href = "<?php echo site_url('employees/edit_employee/'.$id);?>" STYLE = "text-decoration: none">Edit Details</a></li>
                    </ul>
                  </div>
                </li>
                <li>
                  <div class="left">
                    <a href="<?php echo site_url('benefit')  ?>"><img class="avatar" src="<?php echo base_url(); ?>assets/images/travel.jpeg" alt="avatar" /></a>
                  </div>
                  
                  <div class="item">
                           <h3>Benefits</h3>
                    <ul class = "list">
                      
                              <?php echo $benefit;?>
                           <li><a href = "<?php echo site_url('benefit/add_benefit/'.$id) ?>" STYLE = "text-decoration: none">Add New </a> || <a href = "" STYLE = "text-decoration: none">View All</a> </li>
                           
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
         <?php $this->load->view('partial/footer_page.php'); ?>