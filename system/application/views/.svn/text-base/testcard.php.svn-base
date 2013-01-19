<div><?php  require_once('includes/card_navigation.php'); ?></div>



<div id="testcard">
    <div><h3><?php echo 'Card '.$current_testcard . ' of ' . $number_testcards; ?></h3></div>
    <br />
    <?php foreach($query as $row) : ?>
    <span class="translation">
	    <h3><?php echo $row->type; ?></h3>
        <?php echo preg_replace("/\{|\}/", "", $row->text); ?>
	</span>
    <?php endforeach; ?>

    <span class="translation" style="clear:left;">
		<h3>Your translation</h3>
        <?php
        			echo form_open('site/save_answer'.$test_and_card_uri);

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
        echo form_submit('translation', 'Submit');
        echo form_close();

        echo validation_errors('<p class="validation_error">','</p>');

        ?>
	</span>
</div>

<div id="menubar">
    <div id="admin"><?php  echo $admin ? anchor('site/edit'. $test_and_card_uri, 'Edit this testcard') : ''; ?></div>
</div>