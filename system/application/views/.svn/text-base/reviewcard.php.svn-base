<div><?php  require_once('includes/card_navigation.php'); ?></div>


<div id="testcard">
<div><h3><?php echo 'Card '.$current_testcard . ' of ' . $number_testcards; ?></h3></div>

<div style="float:left; clear:left;">
	<?php foreach($query as $row): ?>

         <?php	if ($row->id == 1 || $row->id == 4) : ?>
			<span class="translation">
			<h3><?php echo ($row->id == 1) ? $row->type : $user['first_name'] . ' ' . $user['last_name'] . "'s translation" ;  // Display the type of the translation in the heading ?></h3>
			<?php echo preg_replace("/\{(.+?)\}/", '<span class="comment_link">$1</span>', $row->text ); ?>
			</span>
		<?php endif; ?>
	<?php endforeach; ?>

	
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

<?php // Left side ?>
<div style="float:right; clear: right;">
	<?php foreach($query as $row) : ?>
	 <?php	if ($row->id != 1 && $row->id != 4) : ?>
		<span class="translation">
		<h3><?php echo $row->real_name;  // Display the type of the translation in the heading ?></h3>
		<?php echo preg_replace("/\{(.+?)\}/", '<span class="comment_link">$1</span>', $row->text ); ?>
		</span>
	<?php endif; ?>
	<?php endforeach; ?>
</div>


    

</div>

<div id="menubar">
<div id="admin">
      <?php  echo anchor('site/edit'. $test_and_card_uri, 'Edit this testcard'); ?>
</div>

<div id="lang_selector">Switch to 
  <?php
        foreach ($comment_languages as $language):
	        echo  anchor('site/open'. $test_and_card_uri .'/' . $language,  ucwords($language)) . " "  ;
    endforeach;?>
 comments
</div>

<div id="user_select"><?php echo anchor('site/users_that_took_test' . $test_and_card_uri, 'Select user to review');?>
        </div>

</div>