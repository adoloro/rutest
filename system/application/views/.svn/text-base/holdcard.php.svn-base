<div><?php  require_once('includes/card_navigation.php'); ?></div>



<div id="testcard">
    <div><h3><?php echo 'Card '.$current_testcard . ' of ' . $number_testcards; ?></h3></div>
    <br />

    <div style="float:left; clear:left;">
        <?php foreach($query as $row): ?>
             <?php	if ($row->id == 1 || $row->id == 4) : ?>
                <span class="translation">
                <h3><?php echo $row->type;  // Display the type of the translation in the heading ?></h3>
                <?php echo preg_replace("/\{|\}/", '', $row->text ); ?>
                </span>
            <?php endif; ?>
        <?php endforeach; ?>
	</span>
</div>

<div id="menubar">
    <div id="admin"><?php  echo $admin ? anchor('site/edit'. $test_and_card_uri, 'Edit this testcard') : ''; ?></div>
</div>