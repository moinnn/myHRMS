<?php $this->load->view('partial/header_page.php'); ?>
<div id="wrapper" class="wat-cf"><!--start of the main wrappers-->
      <div id="main">
 
         <div class="block" id="block-lists">
                  <?php echo $access_uri;?>
          
          <div class="content">
            <h2 class="title">Dashboard</h2>
            <div class="inner">
              <ul class="list">
                <li>
                  <div class="left">
                    <a href="<?php echo site_url('employees');?>"><img class="avatar"  src="<?php echo base_url(); ?>assets/images/employeeicon.bmp" alt="avatar" /></a>
                  </div>
                  
                  <div class="item">
                           <h3>Employeees</h3>
                    <ul class = "list">
                           <li><b>Recently Added Employees</b>
                           <ul class = "list">
                                    <?php echo $insert;?>
                                    
                           </ul></li>
                           <li><a href = "<?php echo site_url('employees');?>" STYLE="text-decoration: none">Manage Employees</a></li>
                           <li><a href = "<?php echo site_url('employees/add_employee');?>" STYLE="text-decoration: none">Add New Employee</a></li>
                    </ul>
                    
                  </div>
                </li>
                <li>
                  <div class="left">
                    <a href="<?php echo site_url('leave'); ?>"><img class="avatar" src="<?php echo base_url(); ?>assets/images/leave.jpeg" alt="avatar" /></a>
                  </div>
                  
                  <div class="item">
                           <h3>Leave</h3>
                    <ul class = "list">
                           <li><a href = "" STYLE="text-decoration: none">Pending Leave Request()</a></li>
                           <li><a href = "" STYLE="text-decoration: none">Manage Leave</a></li>
                    </ul>
                  </div>
                </li>
                <li>
                  <div class="left">
                    <a href="<?php echo site_url('travel') ?>" STYLE="text-decoration: none"><img class="avatar" src="<?php echo base_url(); ?>assets/images/travel.jpeg" alt="avatar" /></a>
                  </div>
                  
                  <div class="item">
                           <h3>Travels</h3>
                    <ul class = "list">
                           <li><a href = "" STYLE="text-decoration: none">Pending Travel Request()</a></li>
                           <li><a href = "" STYLE="text-decoration: none">Manage Travel</a></li>
                    </ul>
                  </div>
                </li>
                 <li>
                  <div class="left">
                    <a href="<?php echo site_url('reminder');?>" "STYLE="text-decoration: none"><img class="avatar" src="<?php echo base_url(); ?>assets/images/reminder.jpeg" alt="avatar" /></a>
                  </div>
                  
                  <div class="item">
                           <h3>Reminders</h3>
                    <ul class = "list">
                           <li><a href = "" STYLE="text-decoration: none">Pending Travel Request()</a></li>
                           <li><a href = "" "STYLE="text-decoration: none">Manage Travel</a></li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
          <?php $this->load->view('partial/footer_page.php'); ?>