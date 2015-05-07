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
<?php echo form_input('pword');?>
<?php echo br(2);?>
</div>
</div>

<?php echo form_submit('submit', 'Send');?>
<?php echo form_reset('reset', 'Clear');?>
</div>