<?php

    $GLOBALS['dropdown_columns'] = array ( 'testlevel_id' =>  array(
                                              'column'      => 'testlevel_id',
                                              'label'       => 'Test level',
                                              'options'     => $select_options));

    $GLOBALS['query'] = $query;


    $this->load->view('edit/unit_display_functions');    ?>

<div id="content">
<fieldset>
	<legend><strong>Update <?php echo $model_name; ?></strong></legend>
	<?php echo form_open($model_name.'/update'); ?>
		<table cellpadding="5">
    		<tbody>
                <tr>
                
        		<?php foreach($fields as $field): ?>
        			<?php 
                            $GLOBALS['field'] = $field;

                            if(is_a_primary_key()):

                                    display_hidden();

                                else:

                                    if( is_field_in_dropdown_list() )

                                        display_dropdown();

                                    else
										display_textfield();

                            endif; 
                   ?>
                    </td>
        		<?php endforeach;?>
	           </tr>
               </tbody>
               </table>
    <?php echo br(),form_submit('submit', 'Update the ' . $model_name );
       	  echo form_close();
          
          echo br(), anchor ($model_name . '/manage', "Don't update, return to {$model_name} overview");	?>
</fieldset>
</div>