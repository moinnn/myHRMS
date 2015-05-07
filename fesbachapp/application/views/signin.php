<?php
$this->load->view('partial/header_page.php');
?>
<div id="main" >
        		
       			 <div id="wrapper">
                 			
                   <div class="signInFormHolder"> 
   <div class="signInForm">
        <div class="content">
				    
<form id="form1" name="form1" method="post" action="">
		<h3><?php echo $title;?></h3>
		
       
				    <div class="validation">
		   <h5><?php echo $error;?></h5>
				    </div>
		<ul>
		<li>Username<?php echo form_input('username', set_value('username')) ; ?></li>
		<li>Password<?php echo form_password('password','') ; ?></li>
		</ul>
		 <input name="submit" class = "bluebtn" type="submit" value="Sign In" />
		 <a href="<?php echo site_url('signup') ; ?>">Sign Up</a>
</form>
</div>
</div>
</div>
		   
			 </div>
</div>
</html>
