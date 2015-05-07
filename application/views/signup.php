<?php
$this->load->view('partial/header_page.php');
?>

 




 
 

				    
 <?php
		    $department =  array(
		    		    'N/A' => 'N/A',
		    		    'mmu' => 'MMU',
		    		    'wmu' => 'WMU',
				    'welfare' => 'Welfare',
				    'ushering' => 'Ushering',
				    'choir' => 'Choir',
				    'teenage' => 'Teenager',
				    'lydia' => 'Lydia',
				    'youth organisation' => 'Youth Organisation'
		    );
		    $society = array(
		    		    'N/A' => 'N/A',
				    'busybees' => 'Busybees',
				    'queen esther' => 'Queen Esther',
				    'oreofe' => 'Oreofe',
				    'lovers of christ' => 'Lovers Of Christ'
		    );
		    $marital_status = array(
		                    'N/A' => 'N/A',
		                    'separated' => 'Separated',
		                    'divorced' => 'Divorced',
				    'single' => 'Single',
				    'married' => 'Married'
		    );
		    $title = array(
		    		    'N/A' => 'N/A',
		    		    'pa' => 'Pa',
		                    'ma' => 'Ma',
		                    'master' => 'Master',
		                    'prince' => 'Prince',
		                    'princess' => 'Princess',
				    'doctor' => 'Doctor',
				    'mr' => 'Mr',
				    'mrs' => 'Mrs',
				    'miss' => 'Miss',
				    'chief' => 'Chief'
		    );
		    $radio = array(
				  'yes' => 'Yes',
				  'no' => 'No'
		    );

                    $sex_type = array(
				  'male' => 'Male',
				  'female' => 'Female'
		    );


		    
		    $year = array_combine(range(1,31),range(1,31));
		    
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
                    
                    $textarea = array('col'=>'20');
		    
		    $state = array(
				  'abuja' => 'Abuja',
				  'anambra' => 'Anambra',
				  'akwaibom' => 'Akwaibom',
				  'adamawa' => 'Adamawa',
				  'abia' => 'Abia',
				  'bauchi' => 'Bauchi',
				  'bayelsa' => 'Bayelsa',
				  'benue' => 'Benue',
				  'borno' => 'Borno',
				  'crossriver' => 'CrossRiver',
				  'delta' => 'Delta',
				  'ebonyi' => 'Ebonyi',
				  'edo' => 'Edo',
				  'ekiti' => 'Ekiti',
				  'enugu' => 'Enugu',
				  'gombe' => 'Gombe',
				  'imo' => 'Imo',
				  'jigawa' => 'Jigawa',
				  'kaduna' => 'Kaduna',
				  'kano' => 'Kano',
				  'kastina' => 'Kastina',
				  'kebbi' => 'Kebbi',
				  'kogi' => 'Kogi',
				  'kwara' => 'Kwara',
				  'lagos' => 'Lagos',
				  'nasarawa' => 'Nasarawa',
				  'niger' => 'Niger',
				  'ogun' => 'Ogun',
				  'ondo' => 'Ondo',
				  'osun' => 'Osun',
				  'oyo' => 'Oyo',
				  'plateau' => 'Plateau',
				  'rivers' => 'Rivers',
				  'sokoto' => 'Sokoto',
				  'taraba' => 'Taraba',
				  'yobe' => 'Yobe',
				  'zamfara' => 'Zamfara'
				  
		    );
		    ?>

<div class="validation">
    <h5><?php echo $error;?></h5>
</div>             			             
<div id="contentArea">
    <div class="container_16">
    <div class="">
        <?php echo form_open('signup');?>
        <h3>Personal Information</h3>
        <!--<li>Title<?php echo form_dropdown('title',$title, 'mr');?></li>-->
	<p><b>Surname*</b><br/><?php echo form_input('surname', set_value('sname')) ; ?></p>
        <p>FirstName<br/><?php echo form_input('fname', set_value('fname')) ; ?></p>
        <p>Sex<br/><?php echo form_dropdown('sex',$sex_type, 'male')  ; ?></p>
        <p>Contact Address<br/><?php echo form_textarea('contact_address');?></p>
        <p>city/state<br/><?php echo form_input('state', set_value('state')) ; ?></p>
        <p>Country<br/><?php echo form_input('country', set_value('country')) ; ?></p>
        <p>Phone Number<br/><?php echo form_input('phone', set_value('phone')) ; ?></p>
        <p>Email Address<br/><?php echo form_input('email', set_value('email')) ; ?></p>
        <p>Password*<br/><?php echo form_password('pass', '') ; ?></p>
        <p>Confirm Password*<br/><?php echo form_password('cpass', '') ; ?></p>
        <p>Verification Code<br/><?php echo $cap_img ; ?></p>
        <p>Type in verification Code<br/><?php echo form_input(array('name' => 'captcha', 'value' => '', 'id' => 'vcode')).form_hidden('cap_word',$cap_word) ; ?></p>
        <input name="submit" type="submit"  class = "bluebtn" value="Register" />
        <?php echo form_close();?>
    </div>
    </div>
</div>