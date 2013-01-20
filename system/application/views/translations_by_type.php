<div id="content">
<fieldset>
	<legend><strong>Translations of <?php echo $test_name . ' by ' .
                                               $user['real_name']; ?></strong></legend>
		<table cellpadding="10" cellspacing="0">
    		<tbody>
                <tr>
                    <td>#</td>
                    <td>Original</td>
                    <td><?php echo $user['real_name'];?></td>
                </tr>

                <?php foreach($original as $original_row): ?>
                    <tr valign="top">

                    <td><?php echo $original_row->testcard_nr;?></td>
                    <td><?php echo preg_replace("/\{(.+?)\}/", '<strong>$1</strong>', $original_row->text ); ?></td>


                    <?php
                        $translation = "----";
                        foreach ($query as $row)
                        {
                        if ($original_row->testcard_nr === $row->testcard_nr)
                            $translation = $row->text;
                        }

                     ?>
                     <td><?php echo preg_replace("/\{(.+?)\}/", '<strong>$1</strong>', $translation )?></td>
                     </tr>

                 <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo anchor('site/users_that_took_test' . $test_and_card_uri,
                   "Back to user's list") ?>
</div>