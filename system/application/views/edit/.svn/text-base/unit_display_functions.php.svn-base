<?php


function is_a_primary_key()
{
    global $field;
    return $field->primary_key == 1;
}


function display_checkbox($id, $field, $query)
{

    $data = array(
    'name'        => $field,
    'id'          => $id,
    'value'       => '1',
    'checked'     => ($query[$field] == 0 ) ? FALSE : TRUE ,
    'style'       => 'margin:10px',
);

    echo form_checkbox($data);
}



function display_dropdown()
{

    global $dropdown_columns, $query, $field;


    $dropdown = $dropdown_columns[$field->name];

    $options = $dropdown['options'];
    $value = $query[ $field->name];

    echo form_label($dropdown['label'], $field->name), br();
    echo form_dropdown($field->name, $options, $value), br(2);

}




function display_textfield()
{
    global $query, $field;

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

}


function is_field_in_dropdown_list()
{
    global $field;

    foreach($GLOBALS['dropdown_columns'] as $item)
   {
        if($field->name == $item['column'])
            return true;
   }

   return false;

}


function display_hidden()
{
    global $query, $field;

    echo form_hidden($field->name, $query[$field->name]), br();
}

?>