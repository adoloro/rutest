<div><?php  require_once('includes/card_navigation.php'); ?></div>
<?php require_once('edit_func.php'); ?>

<div id="testcard">

    <div><h3><?php echo 'Card ' . $current_testcard . ' of ' . $number_testcards; ?></h3></div>


    <div style="float:left; clear:left;">
        <?php foreach ($query as $row): ?>
        <?php	 if ($row->id == 1 || $row->id == 4) : ?>
            <span class="translation">
			<h3><?php echo $row->type;  // Display the type of the translation in the heading ?></h3>
                <?php echo preg_replace("/\{(.+?)\}/", '<span class="comment_link">$1</span>', $row->text); ?>
                <?php
                // Display edit button for each translation
                display_edit_translation_button($row, $test_and_card_uri);

                // Display delete button for each translation without comments
                if (!$comment_model->has_comments($row->translation_id)) {
                    // if there's no comments display DELETE (X)
                    // object,    database ,    uri_to_display
                    display_delete_button($row, 'translation', $test_and_card_uri);
                }
                ?>
			</span>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php

        // Add translation code
        echo form_open('site/add' . $test_and_card_uri);
        echo form_hidden('database', 'translation');
        echo form_hidden('id', $testcard_id);
        echo '<input type="submit" name="add_translation" value="Add a new translation" class="input" />';
        echo form_close();
        ?>

        <div id="comments">
            <?php foreach ($query as $row) : ?>
            <?php $comments = $comment_model->get_comments($row->translation_id); ?>
            <?php foreach ($comments as $comment) : ?>
                <?php $comment_text = preg_replace('/--(.+?)--/', '<strong>\1</strong><br />', $comment->text) ?>
                <span class="comment"><?php echo $comment_text; ?></span>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>


        <div class="errors">
            <span class="error_link">Common mistakes</span>
            <?php $errors = $comment_model->get_errors($testcard_id); ?>
            <?php if ($errors != array()) : ?>

            <?php foreach ($errors as $error) : ?>

                <?php if ($edit_error_id == $error->id) : ?>
                    <span class="error" style="display:block;">
						<?php display_error_edit_form($error, $test_and_card_uri); ?>
					</span>
                    <?php else: ?>
                    <span class="error">
	                  <?php 
                        display_edit_error_button($error, $test_and_card_uri);
                        display_delete_button($error, 'error', $test_and_card_uri);
                        echo $error->text;
                        ?>
					</span>
                    <?php endif; ?>
                <br clear="both"/>
                <?php endforeach; ?>

            <?php endif; ?>

            <?php if ($edit_error_id == '') : ?>
            <span class="error">
					<?php display_new_form($testcard_id, $test_and_card_uri, 'error'); ?>
				</span>
            <?php endif; ?>

        </div>


    </div>


    <div style="float:right; clear:right;">
        <?php foreach ($query as $row): ?>
        <?php	 if ($row->id != 1 && $row->id != 4) : ?>
            <span class="translation">
		<h3><?php echo $row->real_name;  // Display the type of the translation in the heading ?></h3>
                <?php echo preg_replace("/\{(.+?)\}/", '<span class="comment_link">$1</span>', $row->text); ?>
                <?php
                // Display edit button for each translation
                display_edit_translation_button($row, $test_and_card_uri);

                // Display delete button for each translation without comments
                if (!$comment_model->has_comments($row->translation_id)) {
                    // if there's no comments display DELETE (X)
                    // object,    database ,    uri_to_display
                    display_delete_button($row, 'translation', $test_and_card_uri);
                }
                ?>
		</span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>


</div>



<div id="menubar">
    <div id="admin">
        <?php if ($admin && $current_testcard == $number_testcards) {
        echo anchor('site/add_testcard' . $test_and_card_uri, 'Add a card');
        echo br();

        if ($query == array()) {
            // If testcard doesn't have any sentences, give a ability to delete.
            echo anchor('site/delete_testcard' . $test_and_card_uri, 'Delete this testcard');
            echo br();
        }
    }

        echo anchor('site/open' . $test_and_card_uri, 'Stop editing');
        ?>
    </div>
</div>