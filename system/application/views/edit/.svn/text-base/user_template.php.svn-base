<?php

    // Settings first
    $GLOBALS['dropdown_columns'] = array ( 'group_id' =>  array(
                                              'column'      => 'group_id',
                                              'label'       => 'Belongs to',
                                              'options'     => $select_options),

                                           'admin' =>    array(
                                              'column'      => 'admin',
                                              'label'       => 'Role',
                                              'options'     => array('Regular user', 'Administrator', 'Guest user')));

    $GLOBALS['query'] = $query;

    $this->load->view('edit/unit_display_functions');

?>




<div id="content">
<fieldset>
	<legend><strong>Update <?php echo $model_name; ?></strong></legend>
	<?php echo form_open($model_name.'/update'); ?>
		<table cellpadding="5">
    		<tbody>
                <tr>
                <td>
        		<?php foreach($fields as $field):

                            $GLOBALS['field'] = $field;

                            if(is_a_primary_key())

                                    display_hidden();

                            else

                                if( is_field_in_dropdown_list() )

                                    display_dropdown();

                                else
                                    display_textfield();


                        endforeach;
                  ?>

                    <br />
                    <?php echo form_submit('submit', 'Update ' . $model_name . ' details');
                                 echo form_close(), br();

                              echo br(), anchor ($model_name . '/manage', "Don't update, return to {$model_name} overview");	?>
                    </fieldset>

                     </td>
                </tr>
                <tr>
                    <td>
                    <table cellpadding="0" cellspacing="0">
                    <?php
                            echo anchor('user/sync_permissions/' . $user_id, "Update user permissions" ); ?>

                            <tr>

                                <td width="60%"><h3><?php echo $query['last_name']?> is allowed to</h3></td>
                                <td width="20%">take the test</td>
                                <td width="20%">to see the results</td>
                            </tr>

                        <?php   foreach($query_perm as $permission): ?>

                            <tr>
                                <td><?php echo $permission['title'] ?></td>

                                <?php echo form_open('permission/update'); ?>

                                <?php echo form_hidden('id', $permission['id']) ?>


                                <td><?php display_checkbox($permission['id'],
                                                             'allowed_to_take_test',
                                                             $permission); ?></td>

                                <td><?php display_checkbox($permission['id'],
                                                             'allowed_to_see_test_result',
                                                             $permission);

                                          echo form_close();

                                
                                    ?>


                                </td>

                            </tr>
                            <?php endforeach; ?>

                     </table>
                    </td>
                </tr>
               </tbody>
               </table>
              <?php echo anchor('user/remove_permissions/' . $user_id, "Remove permissions" ); ?>
    </div>