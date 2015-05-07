<div class="label_field">
<?php echo form_label('Surname', 'Surname');?>
<div class = "form_field">
<?php echo form_input('sname');?>
<?php echo br(2);?>
</div>
</div>


<div class="label_field">
<?php echo form_label('Other Name', 'othername');?>
<div class = "form_field">
<?php echo form_input('oname');?>
<?php echo br(2);?>
</div>
</div>


<div class="label_field">
<?php echo form_label('Project Title', 'projecttitle');?>
<div class = "form_field">
<?php echo form_input('ptitle');?>
<?php echo br(2);?>
</div>
</div>


<div class="label_field">
<?php echo form_label('Upload Picture', 'uploadpicture');?>
<div class = "form_field">
<?php echo form_upload('userfile');?>
<?php echo br(2);?>
</div>
</div>


<div class="label_field">
<?php echo form_label('Category', 'category');?>
<div class = "form_field">
<?php echo form_dropdown('category', array('art', 'culture', 'education', 'music', 'movies', 'humanity'));?>
<?php echo br(2);?>
</div>
</div>


<div class="label_field">
<?php echo form_label('Location', 'location');?>
<div class = "form_field">
<?php echo form_input('location');?>
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
<?php echo form_label('URL Address', 'Urladdress');?>
<div class = "form_field">
<?php echo form_input('url');?>
<?php echo br(2);?>
</div>
</div>

<?php echo form_submit('submit', 'Send');?>
<?php echo form_reset('reset', 'Clear');?>
</div>