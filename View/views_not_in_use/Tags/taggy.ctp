<h3><a href="/oc5/tags/taggy" style="color: red;">Clear</a></h3>
<h3>pick some tags</h3>
<p style="font-size: 6pt;">
<?php
	foreach ($tags as $tag):
	echo $this->Html->link(($tag), array('action' => '../'.$url['url'], $tag));
	echo ' | ';
	endforeach;
	?>
	</p>

<h3>Selected tags</h3>


	<?php
	$pieces=explode('/',$url['url']);
	//debug($pieces);
	foreach ($stags as $tag):
	echo $this->Html->link(($tag), array('action' => '../'.$url['url'] . '?remove='.$tag));
	echo ' | ';
	endforeach;
	?>


<h3>Found <?php echo $trcnt; ?> result(s) </h3>


<?php pr($treasures);?>