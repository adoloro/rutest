<? echo br(2); ?>

<div id="show_create_form" style="cursor: pointer;"><h3>Show create <?php echo $model_name ?></h3></div>

<fieldset>
    
	<legend><strong>Add a new <?php echo $model_name; ?></strong></legend>
	<?php

        echo form_open($model_name.'/create');

        foreach($fields as $field):

            $GLOBALS['field'] = $field;

            if  ( is_a_primary_key()):

                echo br();

            else:

                echo form_label ( ucwords ($field->name), $field->name );

                $data = array( 'name'        => $field->name,
                               'id'          => $field->name,
                               'maxlength'   =>  40 ,// $field->max_length + 10,
                               'size'        => '30',
                               'style'       => 'width:80%');

                echo form_input($data);

            endif;
        endforeach;

        echo br(), form_submit('submit', 'Add a new ' . $model_name );
        echo form_close();
    ?>

</fieldset>