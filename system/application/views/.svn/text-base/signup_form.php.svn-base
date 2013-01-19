<div id="content">

<h1 style="text-align:center">Signup form</h1>

<fieldset>
	<legend>Personal Information</legend>
	
	<?php	
		echo form_open('site/create_user'); 
		echo form_input('first_name', set_value('first_name', 'First Name'));
		echo form_input('last_name', set_value('last_name', 'Last Name'));
	?>
</fieldset>
		
<fieldset>
	<legend>Login</legend>

	<?php	
		echo form_input('email', set_value('email', 'Your e-mail address'));
		echo form_input('password', set_value('password', 'Password'));
		echo form_input('password_confirm', set_value('password_confirm', 'Password Confirm'));

	?>
	
</fieldset>
	
<fieldset>
	<legend>Priviledges</legend>

	<?php	
		echo form_label('Grant Administrative rights', 'admin');
	
		echo form_checkbox('admin', TRUE);
		
		echo br(2);
		
		echo form_submit('submit', 'Create Account');
		  
		echo validation_errors('<p class="error">','</p>');
	?>
	

</fieldset>
	
</div>