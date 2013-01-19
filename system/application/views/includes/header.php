<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>RuN Interactive Translation</title>
	
    <?php echo link_tag('css/rutest.css');  ?>
    

    <?php if(isset($javascript_file)): ?>

        <script>  var base_url = "<?php echo base_url();?>"; </script>

        <script type="text/javascript" src="<?php echo base_url();?>javascript/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url().'javascript/'.$javascript_file ?>"></script>
     <?php endif; ?>
    
</head>
<body>

<h1 style="text-align:center;"><?php echo anchor('', 'RuN Interactive Translation'); ?></h1>