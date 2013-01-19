<div><?php  require_once('includes/card_navigation.php'); ?></div>


<div id="testcard">
<div><h3><?php echo 'Card '.$current_testcard . ' of ' . $number_testcards; ?></h3></div>


<div style="float:left; clear:left;">
	<?php foreach($query as $row): ?>
		 <?php	if ($row->id == 1 || $row->id == 4) : ?>
			<span class="translation">
			<h3><?php echo $row->type;  // Display the type of the translation in the heading ?></h3>
			<?php echo preg_replace("/\{(.+?)\}/", '<span class="comment_link">$1</span>', $row->text ); ?>
			</span>
		<?php endif; ?>
	<?php endforeach; ?>

	<?php if($guest) :?>
		<span class="translation">
			<h3>Demo user translation</h3>
			<?php echo $demo_translation; ?>
		</span>
	<?php endif; ?>
	
	
	<div id="comments">
        <?php foreach ($comments as $comment): ?>
            <span class="comment"><?php echo $comment; ?></span>
        <?php endforeach; ?>
	</div>

	<div class="errors">
		<?php $errors = $comment_model->get_errors($testcard_id); ?>
	     <?php if($errors != array ()) : ?>

	        <span class="error_link">Common mistakes</span>
	        <?php foreach ($errors as $error) : ?>
	                    <span class="error"><?php echo $error->text; ?></span>
	        <?php endforeach;  ?>
	     <?php endif;?>
	</div>
</div>


<!-- left side --!>
<div style="float:right; clear: right;">
    <?php $speaker_count = 0; ?>
	<?php foreach($query as $row) : ?>
	 <?php	if ($row->id != 1 && $row->id != 4) : ?>
		<span class="translation">
		<h3><?php echo ($row->id == 2) ? $row->type : "Native speaker #".$speaker_count; ?></h3>
		<?php $speaker_count = $speaker_count + 1; ?>
		<?php echo preg_replace("/\{(.+?)\}/", '<span class="comment_link">$1</span>', $row->text ); ?>
		</span>
	<?php endif; ?>
	<?php endforeach; ?>
</div>



<?php // require_once('includes/card_navigation.php'); // Insert card navigation)?>
<?php //require_once('includes/lang_switch.php'); // Insert language switch ?>


    

</div>

<div id="menubar">
<?php if($admin) : ?>
    <div id="admin">
        <?php  echo anchor('site/edit'. $test_and_card_uri, 'Edit this testcard'); ?>
    </div>
<?php endif; ?>

<div id="lang_selector">Switch to 
  <?php
    foreach ($comment_languages as $language):
	    echo  anchor('site/open'. $test_and_card_uri .'/' . $language,  ucwords($language)) . " "  ;
    endforeach;
?>
 comments
</div>

</div>