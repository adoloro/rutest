<div><?php  require_once('includes/card_navigation.php'); ?></div>

<div id="testcard">
<div><h3><?php echo 'Card '.$current_testcard . ' of ' . $number_testcards; ?></h3></div>


<?php foreach($query as $row) : ?>
<span class="translation">
    <h3><?php echo $row->type; ?></h3>
<?php echo preg_replace("/\{|\}/", "", $row->text); ?>
</span>
<?php endforeach; ?>


<span class="translation" style="clear:left;">
	<h3>Your translation</h3>
	<?php
		echo form_open('site/save_temp_answer'. $test_and_card_uri);
		echo form_hidden('testcard_id', $testcard_id);
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
		echo form_submit('translation', 'Submit your translation'); 
		echo form_close();	
				
	?>
</span>	

<?php // require('includes/card_navigation.php'); ?>

</div>


