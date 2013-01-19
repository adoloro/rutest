<?php

$this->session->unset_userdata('translation_id');

// Connect functions list
require_once('edit_func.php');

// ***** Helper functions ***************************

// Function to display a form of definite comment

function display_comment($comment, $test_and_card_uri)
{
    echo $comment->text;

    display_delete_button($comment, 'comment', $test_and_card_uri, 'site/edit_translation');
    display_edit_comment_button($comment, $test_and_card_uri);
}


function display_new_commment_form($test_and_card_uri, $translation_id)
{
    echo form_open('site/add_comment' . $test_and_card_uri);
    echo form_hidden('translation_id', $translation_id);

    $data = array(
        'name' => 'comment_text',
        'id' => 'comment_text',
        'rows' => '6',
        'cols' => '6',
        'style' => 'width:95%',
    );
    echo form_textarea($data);
    echo form_submit('comment', 'Add new comment');

}


?>

<div id="testcard">

    <?php	$translation_id;
    // print_r($query);
    ?>

    <?php foreach ($query as $row) : ?>
    <span class="translation">
		    <h3><?php echo $row->real_name; ?></h3>
        <?php

        echo form_open('site/update_translation' . $test_and_card_uri);
        echo form_hidden('translation_id', $row->translation_id);
        $data = array(
            'name' => 'text',
            'id' => 'text',
            'value' => $row->text,
            'rows' => '5',
            'cols' => '6',
            'style' => 'width:95%',
        );
        echo form_textarea($data);
        echo br();
        echo form_submit('translation', 'Update');
        echo form_close();

        echo validation_errors('<p class="validation_error">', '</p>');
        ?>
		</span>
    <?php endforeach; ?>


    <div id="comments">
        <?php foreach ($comments as $comment) : ?>


        <span class="comment_edit">
				<?php

            if ($comment_edit_id == $comment->id)
                display_comment_edit_form($comment, $test_and_card_uri);
            else
                display_comment($comment, $test_and_card_uri);

            ?>
			</span>
        <?php endforeach;  ?>
        <br/>
        <?php     if ($comment_edit_id == ''): ?>
        <br clear="both"/>

        <span class="comment_edit">
            <h3>New comment</h3>
            <?php
                display_new_commment_form($test_and_card_uri, $translation_id);?>
		</span>
        <?php endif; ?>
    </div>
    <!-- end comments  -->
</div>


<div id="menubar">
    <div id="admin">
        <?php  echo anchor('site/edit' . $test_and_card_uri, 'Edit this testcard'); ?>
    </div>
</div>