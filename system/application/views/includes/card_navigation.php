<div id="navigation">
    <span style="float:left;">
        <?php  
            if($current_testcard > 1)
                echo anchor('site/' . $navigate_to . '/' . $current_test . '/' . ($current_testcard-1), '<< Previous card');
			else
				echo "&nbsp;"
            ?>
    </span>
    <span style="float:right;">
        <?php  
            if($current_testcard < $number_testcards)
                echo anchor('site/' .  $navigate_to . '/'. $current_test . '/'.($current_testcard+1) , 'Next card >>');
			else
				echo '&nbsp;';
        ?>
    </span>
</div>
