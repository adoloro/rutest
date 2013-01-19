<div id="content" style="width: 500px;">
<?php
      $this->load->helper('inflector');
      $this->load->helper('url');
      $this->load->view('edit/unit_display_functions');


    function generate_label($label, $active )
    {
        $label_html =   '<span style = "padding: ';

        $label_html .=  '2pt 5pt 2pt 5pt;'  ;

        $label_html .=  'background-color:#' . $label['label-background'] .'; '  ;

        $label_html .= 'font:';
        $label_html .=   ($active) ? '14' : '11'  ;
        $label_html .=  'px arial,sans-serif;';

        $label_html .=  'color:' . $label['text-color'] .';">';

        $label_html .=  '<nobr>' . $label['name'] . '</nobr></span>';

        return $label_html;
    }

?>


<h3><?php echo humanize(plural($model_name)) ;?></h3>

    <?php
            // Prepare data for displaying labels

            $label_data[999] = array('label-background' =>  "444" ,
                                        'text-color'       =>  "white",
                                        'name'             =>  'All users');


            $label_data[0] = array('label-background' =>  "678" ,
                        'text-color'       =>  "white",
                        'name'             =>  'No group');



            foreach($groups as $group):
                $label_data[$group->id] = array(
                      'label-background' => (empty($group->label_background)) ? "333" : $group->label_background,
                      'text-color'       => (empty($group->label_color))    ? "white" : $group->label_color,
                      'name'             => $group->name); ?>
            <?php endforeach;        ?>





<?php foreach($label_data as $id => $label) :?>
        <span>
               <?php  // List all the groups of users
                    echo ($current_group == $id)
                              ? generate_label($label, true)
                              : '<a href="' . site_url('user/set_user_group/'. $id) . '" >'.
                                  generate_label($label, false) .'</a>';  ?>
        </span>
<?php endforeach; ?>


<br />
<br />


<table cellpadding="3" width="100%">
    <tbody>

    <?php foreach($query as $item): ?>

        <tr>
                <?php $label = $label_data[$item->group_id] ?>
                <td><?php echo '<span style="padding: 2pt 5pt 2pt 5pt;
                                background-color:#' . $label['label-background'] .  ';
                                font: 11px arial,sans-serif;
                                color:' . $label['text-color'] .';  "><nobr>' .
                                $label['name'] . '</nobr></span>'  ?></td>
            
                <td><nobr><?php echo $item->first_name . ' ' . $item->last_name; ?></nobr></td>
                <td><?php echo anchor($model_name . '/edit/' . $item->id, $item->email );  ?> </td>
                <td><?php echo anchor("admin/login_as/". $item->id, "<nobr>Log in as</nobr>"); ?></td>

            </tr>
    <?php endforeach; ?>
    </tbody>
 </table>

<?php echo br(2); ?>

<?php $this->load->view('manage/create_new'); ?>
</div>