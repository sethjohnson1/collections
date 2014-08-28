

	<?php
	
	foreach ($tags as $tag):
	echo $this->Html->link(($tag), array('action' => '../'.$url['url'], $tag));
	echo ' | ';
	endforeach;
	
	?>
<h3>Found <?php echo $cnt; ?> result(s) </h3>

<?php pr($treasures); ?>