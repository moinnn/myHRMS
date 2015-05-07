<?php echo form_open('register/signup');?>
<?php echo validation_errors(); ?>

<?php $this->load->view("pages/forms/signup_info");?>

<?php echo form_close();?>