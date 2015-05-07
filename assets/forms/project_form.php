<?php
	echo validation_errors();
	echo form_open('register/start_project');
	
	$this->load->view('pages/forms/project_info');
	
	echo form_close();
	?>