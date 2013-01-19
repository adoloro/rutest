<div id="content">
<div style="text-align:center">

	<div class="login">
	<p class="error">
		<?php if(isset($errors)) 
	 			echo $errors;	
	 	?>	
	</p>
		
	<?php		 echo form_open('login/validate_credentials') ?>
	<?php
		$email_input = array(
		              'name'        => 'email',
		              'id'          => 'email',
		          
		              'maxlength'   => '30',
		              'size'        => '30'             
		            );
	//     'value'       => 'Enter your email here',
	
	
		$password_input = array (
					'name'		=> 'password',
					'id'		=> 'password',
					'maxlength'	=> '30',
					'size'		=> '30'		
		);

		echo form_input($email_input);
		echo form_password($password_input);
	
	 ?>
	<?php echo form_submit('login', 'Login'); ?>

	<?php echo form_close(); ?>
	
	<?php 
		echo form_open('login/validate_credentials');
		echo form_hidden('email', 'guest@guest.no');
		echo form_hidden('password', 'guest');
		echo form_submit('login', 'Demo');
		echo form_close();
	?>
	</div>

</div>

</div>