<?php
$this->load->view('partial/header_page.php');
?>

 




 
 <div id="main" >
		  <div id="wrapper">
		          <h3><?php #echo $header;?></h3>
				    <div class="validation">
						      <h5><?php echo $error;?></h5>
				    </div>
                 			
                   <div class="signInFormHolder"> 
				    <div class="signInForm">
						      <div class="content">
									<div class="title"></div>
				    
 <?php
		    $department =  array(
				    'welfare' => 'Welfare',
				    'ushering' => 'Ushering',
				    'choir' => 'Choir',
				    'teenage' => 'Teenage',
				    'lydia' => 'Lydia',
				    'youth organisation' => 'Youth Organisation'
		    );
		    $society = array(
				    'busybees' => 'Busybees',
				    'queen esther' => 'Queen Esther',
				    'lovers of christ' => 'Lovers Of Christ'
		    );
		    $marital_status = array(
				    'single' => 'Single',
				    'married' => 'Married'
		    );
		    $title = array(
				    'doctor' => 'Doctor',
				    'mr' => 'Mr',
				    'mrs' => 'Mrs',
				    'miss' => 'Miss',
				    'chief' => 'Chief'
		    );
		    $radio = array(
				  'yes' => 'yes',
				  'no' => 'no'
		    );
		    
		    $year = array_combine(range(1900,2012),range(1900,2012));
		    
		    $month = array(
				  'january' => 'January',
				  'february' => 'February',
				  'march' => 'March',
				  'april' => 'April',
				  'may' => 'May',
				  'june' => 'June',
				  'july' => 'July',
				  'august' => 'August',
				  'september' => 'September',
				  'october' => 'October',
				  'november' => 'November',
				  'december' => 'December'
		    );
		    
		    $state = array(
				  'delta' => 'Delta',
				  'edo' => 'Edo'
		    );
		    ?>

		   
		   <?php echo form_open_multipart('signup');?>

		    <h3>Personal Information</h3>		    
 <ul>        
		    <li>Title<?php echo form_dropdown('title',$title, 'mr');?></li>
		    <li>Surname*<?php echo form_input('sname', set_value('sname')) ; ?></li>
		    <li>FirstName<?php echo form_input('fname', set_value('fname')) ; ?></li>
		    <li>Other Names<?php echo form_input('oname', set_value('oname')) ; ?></li>
		    <li>Date Of Birth<?php echo form_dropdown('month', $month) ; ?><?php echo form_dropdown('dob', $year) ; ?></li>
		    <li>Phone Number<?php echo form_input('phone', set_value('phone')) ; ?></li>
		    <li>State Of origin<?php echo form_dropdown('state', $state) ; ?></li>
		    <li>Fellowship<?php echo form_input('fellowship', set_value('fellowship')) ; ?></li>
		    <li>Occupation<?php echo form_input('occupation', set_value('occupation')) ; ?></li>
		    <li>Have You Been Baptised<?php echo form_radio('baptised', 'yes')  ; ?>Yes <?php echo form_radio('baptised', 'no') ; ?> No</li>
		    <li>Have You Been Discipled<?php echo form_radio('discipled', 'yes') ; ?>Yes <?php echo form_radio('discipled', 'no') ; ?>No</li>
		    <li>Area Of Interest<?php echo form_input('aoi', set_value('aoi')) ; ?></li>		   
		    <li>Marital Status<?php echo form_dropdown('marital_status',$marital_status, 'married');?></li>
		    <li>Contact Address<?php echo form_textarea('contact_address');?></li>
		    
		    <li>Department<?php echo form_dropdown('department',$department,'welfare');?></li>
		    <li>Society<?php echo form_dropdown('society',$society, 'busybees');?></li>
		    <li>Upload File<?php echo form_upload('userfile');?></li>
		    
		    <h3>Login Information</h3>
		    <li>Email Address<?php echo form_input('email', set_value('email')) ; ?></li>
		    <li>Username*<?php echo form_input('uname', set_value('uname')) ; ?></li>
		    <li>Password*<?php echo form_password('pass', '') ; ?></li>
		    <li>Confirm Password*<?php echo form_password('cpass', '') ; ?></li>
		    <li>Verification Code<?php echo $cap_img ; ?></li>
		    <li>Type in verification Code<?php echo form_input(array('name' => 'captcha', 'value' => '', 'id' => 'vcode')).form_hidden('cap_word',$cap_word) ; ?></li>
		  
		   

		</ul>
		
		<input name="submit" type="submit"  class = "bluebtn" value="Register" />
	  <?php echo form_close();?>
 </div>
			 </div>
		   </div>
			 </div>
 </div>
 
 </div>
</html>