<html>
<head>
<title>Fesbach || User Profile</title>
<link href="<?php echo base_url() ; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
 
 <div id="pgMenu">
        			<div id="wrapper">
                    			<div class="pgTitle">
                                			<h2>Fesbach User Application</h2>
							
                                </div>
                        </div>
				
                        
        </div>
<div id="main" >
        		
       			 <div id="wrapper">
			      
				    <div class="validation">
		   <h5></h5>
				    </div>
                 			
                   <div class="signInFormHolder"> 
   <div class="signInForm">
        <div class="content">
     
     <?php
     $month_list =  array(
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
     
     $birth_list = array_combine(range(1900,2012),range(1900,2012));
     
     $option = array(
			       'yes' => 'Yes',
			       'no' => 'No'
     );
     
     $department_list =  array(
				    'welfare' => 'Welfare',
				    'ushering' => 'Ushering',
				    'choir' => 'Choir',
				    'teenage' => 'Teenage',
				    'lydia' => 'Lydia',
				    'youth organisation' => 'Youth Organisation'
		    );
		    $society_list = array(
				    'busybees' => 'Busybees',
				    'queen esther' => 'Queen Esther',
				    'lovers of christ' => 'Lovers Of Christ'
		    );
		    $marital_status_list = array(
				    'single' => 'Single',
				    'married' => 'Married'
		    );
		    $title_list = array(
				    'doctor' => 'Doctor',
				    'mr' => 'Mr',
				    'mrs' => 'Mrs',
				    'miss' => 'Miss',
				    'chief' => 'Chief'
		    );
                    ?>
			    
<form id="form1" name="form1" method="post" action="userprofile">
		<h3>User Profile</h3>
        <img src= "<?php echo base_url().'folders/images/member_data/'.$userfile;?>">
	<br/>
        Title*<br/><?php echo form_dropdown('title', $title_list, ucfirst($title)) ; ?>
        SurName*<?php echo form_input('surname', ucfirst($surname)) ; ?>
        FirstName*<?php echo form_input('first_name', ucfirst($first_name)) ; ?>
        Other Names*<?php echo form_input('other_names', ucfirst($other_names)) ; ?>
	Month<?php echo form_dropdown('month', $month_list, ucfirst($month)) ; ?>
	Birth Year<?php echo form_dropdown('date_of_birth', $birth_list, ucfirst($date_of_birth)) ; ?>
        Email Address*<?php echo form_input('email', $email) ; ?>
        Mobile*<?php echo form_input('phone_number', ucfirst($phone_number)) ; ?>
        Marital Status*<?php echo form_dropdown('marital_status', $marital_status_list,ucfirst($marital_status)) ; ?>
        Department*<?php echo form_dropdown('department', $department_list, ucfirst($department)) ; ?>
        Society*<?php echo form_dropdown('society',$society_list, ucfirst($society)) ; ?>
        Fellowship<?php echo form_input('fellowship', ucfirst($fellowship)); ?>
        <br/>
        State<br/><?php echo form_input('state', ucfirst($state)); ?>
        Occupation<?php echo form_input('occupation', ucfirst($occupation)); ?>
	<li>Have You Been Baptised<br/><?php echo form_radio('baptised', 'yes')  ; ?>Yes <?php echo form_radio('baptised', 'no') ; ?> No</li>
        <li>Have You Been Discipled<br/><?php echo form_radio('discipled', 'yes') ; ?>Yes <?php echo form_radio('discipled', 'no') ; ?>No</li>
        <li>Area Of Interest<?php echo form_input('aoi',ucfirst($area_of_interest)) ; ?></li>
        Contact Address<?php echo form_textarea('contact_address', ucfirst($contact_address)); ?>
        
        <input name="submit" type="submit" class="bluebtn"  value="Update Profile" />
        
</form>
        </div>
   </div>
                   </div>
                         </div>
</div>
