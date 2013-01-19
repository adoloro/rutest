<div id="testcard">
<?php


// Check first if this test card has an original.

    function testcard_has_original($query)
    {
        foreach($query as $row) 
            if($row->id == 1) return true;
        return false;
    }



    
    $testcard_has_original = testcard_has_original($query);
?>


<div>
	<?php // Decide what to display in the header?>
	<h3>Adding <?php if(!$testcard_has_original) echo 'original/';?>translation to the testcard</h3>	
</div>

	<span class="translation" style="float:right; clear: right;">
		<?php
			echo form_open('site/save_translation'.$test_and_card_uri);
	        echo form_hidden('user_id', '0');
	        echo form_hidden('testcard_id', $testcard_id);
	    ?>

	    <select name="type_id" id="type_id">        
	    <?php    
	        foreach($types as $type):
	            if(($testcard_has_original && ($type->id == 1)) || ($type->id == 4))
	                continue;
	            else
	                echo '<option value="'.$type->id.'">'.$type->real_name.'</option>';
	        endforeach; 
	    ?>
	    </select>

	    <?php  


			$data = array(
		              'name'        => 'text',
		              'id'          => 'text',
		              'value'       => '',
		              'rows'   		=> '5',
		              'cols'        => '6',
		              'style'       => 'width:95%',
		            );
			echo form_textarea($data);
			echo br();
	        echo '<span class="comment_link" style="float:right;">Help</span>';
			echo form_submit('translation', 'Add'); 
	        echo form_close();	

			echo validation_errors('<p class="validation_error">','</p>'); 

		?>

	</span>

<?php
// Display all the cards that already are in the database
 foreach($query as $row) : ?>
	<span class="translation" 
	<?php echo ($row->id == 1 || $row->id == 4) ? 'style="float:left; clear:left;"' : 'style="float:right; clear:right;"'; ?> >
<h3><?php echo $row->real_name; ?></h3>

<?php echo preg_replace("/\{(.+?)\}/", '<strong>$1</strong>', $row->text ); ?>
</span>
<?php endforeach; ?>



<div class="comments">
    <span class="comment">Please select the form. <br />Use { } mark links.</span>
</div>

</div>


<div id="admin">
    <?php echo anchor('site/edit'. $test_and_card_uri , 'Don\'t save, <br/> back to card editing'); ?>
</div>
