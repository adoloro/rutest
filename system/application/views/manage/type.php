<?php

require_once('edit_func.php');


//function display_remove($object, $database_to_delete_from = $model_name, $return_to)
//{
//        display_delete_button($object, $model_name, '', $model_name.'/create', $model_name.'/delete');
//}


?>

<div id="content">


<?php $this->load->helper('inflector'); ?>

<h3><?php echo humanize(plural($model_name)) ;?> available:</h3>

<table cellpadding="5">
    <tbody>
        <tr>
            <th>id</th>
            <th>Alias</th>
            <th>Real name</th>
        </tr>
        
       	<?php foreach($query as $item): ?>
        <tr>
            <td><?php echo $item->id; ?>.</td>
            <td><?php echo $item->type; ?></td>
        	<td><?php echo $item->real_name; ?></td>
            <td><?php display_edit_link($model_name, $item->id); ?> </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
 </table>

<?php echo br(2); ?>

<?php $this->load->view('manage/create_new'); ?>

		
</div>