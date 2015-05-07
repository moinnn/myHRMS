<?php
	echo validation_errors();
	echo form_open('register/signin');
	
	$this->load->view('pages/forms/signin_info');
	
	echo form_close();
	?>