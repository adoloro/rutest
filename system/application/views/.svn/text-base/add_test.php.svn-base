<?php

require_once('edit_func.php');


function display_remove($object, $database_to_delete_from = "test", $return_to = "site/add_test")
{
        display_delete_button($object, 'test', '', 'site/add_test', 'site/delete');
}


?>

<div id="content">

<h3>Tests available:</h3>
<ol>
	<?php foreach($query as $row): ?>
	<li><?php echo $row->title; ?>&nbsp;<?php if ($test_model->get_number_of_testcards($row->id) == 0) {display_remove($row);}  ?></li>
	<?php endforeach; ?><br />
</ol>

<fieldset>
	<legend>Add a new test</legend>
	
	<?php	
		echo form_open('util/create_test'); 
		echo form_input('test_name', set_value('test_name'));
		echo form_submit('submit', 'Add test');
        		
	?>
	
</fieldset>
		

		
</div>