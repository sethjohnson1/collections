<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head>
	<?php echo $this->Html->charset(); 
	
	//begin jQuery regular and mobile
	echo $this->Html->script('http://code.jquery.com/jquery-1.9.1.min.js');
	echo $this->Html->script('http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js');
	echo $this->Html->script('mobile/sj');
	echo $this->Html->css('http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css');
	echo $this->Html->css('mobile/sj');
	echo $this->Html->meta(array('name'=>'viewport','content'=>'width=device-width, initial-scale=1'));
	
	//my script uses jQuery, so it only works when loaded AFTER!
	echo $this->Html->script('sj_cookie1');	
	//this one too

	echo '<title>Mobile</title>';
	echo $this->Html->meta('icon');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');


	
?>
</head>
<body>

<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content'); ?>

</body>