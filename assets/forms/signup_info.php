<div class="label_field">
<?php echo form_label('Surname', 'Surname');?>
<div class = "form_field">
<?php echo form_input('surname');?>
<?php echo br(2);?>
</div>
</div>

<div class="label_field">
<?php echo form_label('Other Name', 'Othername');?>
<div class = "form_field">
<?php echo form_input('other_name');?>
<?php echo br(2);?>
</div>
</div>

<div class="label_field">
<?php echo form_label('Email', 'Email');?>
<div class = "form_field">
<?php echo form_input('email');?>
<?php echo br(2);?>
</div>
</div>

<div class="label_field">
<?php echo form_label('Password', 'Password');?>
<div class = "form_field">
<?php echo form_password('pword');?>
<?php echo br(2);?>
</div>
</div>

<div class="label_field">
<?php echo form_label('Confirm Password', 'ConfirmPassword');?>
<div class = "form_field">
<?php echo form_password('passconf');?>
<?php echo br(2);?>
</div>
</div>

<?php echo form_submit('submit', 'Send');?>
<?php echo form_reset('reset', 'Clear');?>
</div>