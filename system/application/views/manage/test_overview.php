<div id="content" style="width: 450px; margin: 50px auto auto;">
<?php

    $this->load->helper('inflector');

    function demistify_id($id, $categories)
    {

        foreach ($categories as $category):

            $category = (array)$category;
            if($id == $category['id'])
                return $category['level_name'];
            endforeach;
    }
?>


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
            <?php echo (($item[$field->name] != '') ?
                    anchor ($edit_link, ($field->name == "testlevel_id") ? demistify_id ($item[$field->name],$testlevels)
                       : $item[$field->name]) : "---"); ?>
            </td>
         <?php endforeach; ?>
         </tr>
        <?php endforeach; ?>
    </tbody>
 </table>


<?php $this->load->view('manage/create_new'); ?>

</div>