<div id="content">
<fieldset>
	<legend><strong>Update <?php echo $model_name; ?></strong></legend>
	<?php echo form_open($model_name.'/update'); ?>
		<table cellpadding="5">
    		<tbody>
                <tr>
                
        		<?php foreach($fields as $field): ?>
        			<?php 
                            if($field->primary_key == 1):
                                    echo form_hidden($field->name, $query[$field->name]),br();
                                else:
                                    echo form_label(ucwords($field->name), $field->name); 	
                                    $data = array(
                                          'name'        => $field->name,
                                          'id'          => $field->name,
                                          'value'       => $query[$field->name],
                                          'maxlength'   => '40',
                                          'size'        => '30',
                                          'style'       => 'width:80%'                                     
                                    );
                                    echo form_input($data);
                            endif; 
                   ?>
                    </td>
        		<?php endforeach;?>
	           </tr>
               </tbody>
               </table>
    <?php echo form_submit('submit', 'Update the ' . $model_name );
       	  echo form_close();
          
          echo br(), anchor ($model_name . '/manage', "Don't update, return to {$model_name} overview");	?>
</fieldset>
</div>