<div id="content">
<fieldset>
    <legend>Translators in this test</legend>
    <table cellpadding="5" cellspacing="5">
    <?php foreach ( $native_translators as $translator) :  ?>
    <tr>
        <td><?php echo anchor('site/view_all_translations_by_type' . $test_and_card_uri . '/' . $translator->id,
                                         '<strong>' . $translator->real_name  . "</strong>");

            ?></td>
    </tr>

    <?php endforeach; ?>
    </table>
</fieldset>
<fieldset>
	<legend><strong>Users that took test</strong></legend>
	<?php echo form_open('site/set_user_we_review'); ?>
		<table cellpadding="5" cellspacing="5">
    		<tbody>
        		<?php foreach($query as $row): ?>
                <tr>
                    <td>

        			<?php echo
                          anchor('site/set_user_we_review'.
                                      $test_and_card_uri . '/' . $row->id,
                                     "Switch to " . '<strong>' . $row->first_name . " " . $row->last_name .
                                       "'s </strong> translations"
                                      );     ?>
                   <td><?php echo anchor('site/view_all_translations_for_user' . $test_and_card_uri . '/' . $row->id,
                                         'Print <strong>' . $row->first_name . " " . $row->last_name .
                                       "'s </strong> translations"); ?></td>
                 <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
</div>