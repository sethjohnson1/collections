<!DOCTYPE html>
<html>
<head>
<? //the title can be updated later ?>
	<title>
Collections | <? echo $this->fetch('title'); ?>
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<?
		//echo $this->Html->meta('description', $meta_description );
		echo $this->Html->css('jquery.mobile-1.4.5');	
		echo $this->Html->css('themes/iscout1.min');		
		echo $this->Html->css('themes/jquery.mobile.icons.min');			
		echo $this->Html->css('style');		
	
		echo $this->Html->script('jquery-1.11.2.min');
		echo $this->Html->script('jquery.mobile-1.4.5.min');			
		echo $this->Html->script('qr_scripts');
		
		echo $this->fetch('script');
		echo $this->fetch('css');
		echo $this->fetch('meta');
	?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46559601-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
	<?=$this->fetch('content')?>
</body>
</html>