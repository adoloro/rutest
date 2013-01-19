<div id="content">
	<div id="login">
	
	<?php  if( $admin): ?>

        <h2>Administrate</h2>

        <?php	echo anchor('user/manage',  'Users')       . br();
                echo anchor('group/manage', 'Groups')      . br();
                echo anchor('type/manage',  'Translators') . br();
                echo anchor ('test/manage',      'Tests')  . br();
                echo anchor ('testlevel/manage', 'Test levels');
                echo br(2);                                              ?>

	<?php endif; ?>



	<?php if($test_levels == array ()): ?>

        <h3>No tests for you :)</h3>

    <?php else : ?>



	<h2>Choose your test level</h2>
	
	<?php echo ($current_test_level == 'all')
                                ? '<strong>All levels</strong>'
                                : anchor('site/test_level/all', 'All levels');
          echo br();

     ?>





	<?php foreach($test_levels as $test_level): ?>

        <?php echo  ($current_test_level == $test_level->testlevel_id)
                        ? '<strong>'. $test_level->level_name .'</strong>'
                        : anchor('site/test_level/' .
                        $test_level->testlevel_id, $test_level->level_name);
                echo br(); ?>
	<?php endforeach; ?>
	




	<h2>Choose a test</h2>

     <?php $default_action = ($admin) ? 'open/' : 'test/'; ?>

        <?php

            $label_data = array (  1 => array ('label-background' =>'E9DF9C',
                                               'text-color' =>'black' ),
                                   3 => array ('label-background' => '9AAB96',
                                                'text-color' => 'black'),
                                   9 => array ('label-background' => '122E5A',
                                                'text-color' => 'white'),
                                   10 => array ('label-background' => '3C5C88',
                                                'text-color' => 'white'),
                                   12 => array ('label-background' => '3C8C88',
                                                'text-color' => 'white')
            );

        foreach($query as $row)
        {

            echo '<div>
                   <span style="padding: 2pt 5pt 2pt 5pt;
                                margin-right:6pt;
                                background-color:#' . $label_data[$row->order]['label-background'] .  ';
                                font: 11px arial,sans-serif;
                                color:' . $label_data[$row->order]['text-color'] .';  ">' .


                    $row->level_name . '</span>' .

                     anchor('site/'. $default_action . $row->id.'/1', $row->title) . '</div>' . br();
        }
	    ?>

    <?php endif; ?>
	</div>

</div>

    
<div id="menubar">
    <div id="admin">
        <?php echo anchor('site/logout', 'Log out') ?>
    </div>
</div>