<?php
	

	// Display "Edit" button
	function display_edit_button($object, $test_and_card_uri, $return_to = "site/edit_translation")
	{
		echo form_open($return_to . $test_and_card_uri);  
	    echo form_hidden('id', $object->id);
    
	    echo '<input type="submit" name="edit'. $object->id . '" value="edit" class="input" />';
	    echo form_close();
	}
    
    

	// Display  "Edit translation" button
    function display_edit_translation_button($object, $test_and_card_uri, $return_to = "site/edit_translation")
    {
        
       	echo form_open($return_to . $test_and_card_uri);  
	    echo form_hidden('id', $object->translation_id);
    
	    echo '<input type="submit" name="edit'. $object->translation_id . '" value="edit" class="input" />';
	    echo form_close();

        
    }
	

	// Display "Edit error" button
	function display_edit_error_button($object, $test_and_card_uri)
	{
		echo form_open('site/edit' . $test_and_card_uri);
		echo form_hidden('error_id', $object->id);
		
		echo '<input type="submit" name="edit_error" value="edit" class="input" />';
		echo form_close();
	
	}
    
    
    function display_edit_link ($table_name, $id)
    {
        echo anchor ($table_name . '/edit/' . $id, 'edit');
    }

	
	
	
	// Display "Edit comment" button
	function display_edit_comment_button($comment, $test_and_card_uri)
	{
		echo form_open('site/edit_translation' . $test_and_card_uri);  
		echo form_hidden('comment_edit_id', $comment->id);
		echo form_hidden('translation_id', $comment->translation_id);
	    echo '<input type="submit" name="comment_edit'. $comment->id . '" value="edit" class="input" />';
	    echo form_close();
		
	}
		
	
	
	// Display error edit form
	function display_error_edit_form($error, $test_and_card_uri)
	{
		echo form_open('site/update_errors'. $test_and_card_uri);
		echo form_hidden('error_id', $error->id );

		$data = array(
	              'name'        => 'error_text',
	              'id'          => 'error_text',
	              'value'       => $error->text,
	              'rows'   		=> ( (int)(strlen($error->text) / 45) ),
	              'cols'        => '6',
	              'style'       => 'width:95%',
	            );
		echo form_textarea($data);
		echo '<input type="submit" name="error_update" value="Update" class="input" />';
	}
	
	
	
	// The 1st parameter is the id of the super object it should be connected to, 
	// The 2nd parameter is the just a string to show which test and card we're on
	// The 3rd parameter is what this new form is for: 'comment' or 'error'. 
	function display_new_form($id, $test_and_card_uri, $form_for)
	{
		$connect_to = '';
		
		if($form_for == 'comment')
			$connect_to = "translation_id";
		elseif($form_for == 'error')
			$connect_to = "testcard_id";
		
	
	
		echo form_open('site/add_'.  $form_for .  $test_and_card_uri);
		echo form_hidden($connect_to, $id );

		$data = array(
	              'name'        => $form_for . '_text',
	              'id'          => $form_for . '_text',
	              'rows'   		=> '6',
	              'cols'        => '6',
	              'style'       => 'width:95%',
	            );
		echo form_textarea ($data);
		echo form_submit   ($form_for, 'Add new ' . $form_for); 
		
	}
	

	
	function display_comment_edit_form ($comment, $test_and_card_uri)
	{		
		echo form_open('site/update_comments'. $test_and_card_uri);
		echo form_hidden('comment_id', $comment->id );
		echo form_hidden('translation_id', $comment->translation_id);

		$data = array(
	              'name'        => 'comment_text',
	              'id'          => 'comment_update_'.$comment->id,
	              'value'       => $comment->text,
	              'rows'   		=> ( (int)(strlen($comment->text) / 45) ),
	              'cols'        => '6',
	              'style'       => 'width:95%',
	            );
		echo form_textarea($data);
		echo '<input type="submit" name="comment_update' . $comment->id . '" value="Update" class="input" />';
	}
	
	

	
	function display_delete_button($object, $database_to_delete_from, $test_and_card_uri, $return_to = 'site/edit', $remove_controller = "site/delete")
	{
	   $id = $object->id;
       
       if($database_to_delete_from == 'translation')
       {
            $id = $object->translation_id;
       }
       
       
		echo form_open($remove_controller . $test_and_card_uri);  
        echo form_hidden('database', $database_to_delete_from); // The same as database name
        echo form_hidden('id', $id); // translation_id
        
        if($database_to_delete_from == 'comment')
        {
           echo form_hidden('translation_id', $object->translation_id);
        }
        
        echo form_hidden('return_to', $return_to); 
        echo '<input type="submit" name="delete_'. $database_to_delete_from . '" value="X" class="input" />';
        echo form_close();
        
	}
	

?>