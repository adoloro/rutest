<div id="content" style="width: 450px; margin: 50px auto auto;">
<?php $this->load->helper('inflector');

//print_r($message);
 ?>

<?php if (isset($message) &&  $message != ''): ?>
    <div class="clean-gray-message-box"><?php echo $message; ?></div>
<?php endif; ?>

<h3><?php echo humanize(plural($model_name)) ;?></h3>

<table cellpadding="5" width="95%">
    <tbody>
    
        <tr>
        <?php foreach ($fields as $field): ?>        
            <td><?php echo $field->name ?></td>
        <?php endforeach; ?>
        </tr>
        
        
       	<?php foreach($query as $item): ?>
            <tr>
            <?php foreach ($fields as $field): ?>
                <td>
                <?php $item = (array)$item;
                
                 ?>
                <?php $edit_link = $model_name . '/edit/' . $item['id']; ?>
                <?php echo (($item[$field->name] != '') ? anchor ($edit_link, $item[$field->name]) : "---"); ?>
                </td>
             <?php endforeach; ?>  
            </tr>
        <?php endforeach; ?>
    </tbody>
 </table>

<?php echo br(2); ?>
<fieldset>
	<legend><strong>Add a new <?php echo $model_name; ?></strong></legend>
	<?php echo form_open($model_name.'/create'); ?>
		<table cellpadding="5">
    		<tbody>
                <tr>
                
        		<?php foreach($fields as $field): ?>
        			<?php 
                            if($field->primary_key == 1):
                                    echo br();
                                else:
                                    echo form_label(ucwords($field->name), $field->name); 	
                                    $data = array(
                                          'name'        => $field->name,
                                          'id'          => $field->name,
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
    <?php echo form_submit('submit', 'Add a new ' . $model_name );
       	  echo form_close();
          
          	?>
</fieldset>
</div>