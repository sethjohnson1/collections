<div class="gallery">
	<?php
    echo'<div class="head">';
		if(!empty($usergal['Usergal']['name']))
			echo '<h2>'.$usergal['Usergal']['name'].'</h2>';
		if(!empty($usergal['Usergal']['creator']))
			echo '<strong>Curated by:</strong> '.$usergal['Usergal']['creator'];
		if(!empty($usergal['Usergal']['gloss']))
			echo '<br><em>'.$usergal['Usergal']['gloss'].'</em>';
    echo'</div>';	
    echo '<div class="flag">';
		//echo $this->Form->postLink('Flag as Inappropriate', array('action' => 'dousergal','x:'.$usergal['Usergal']['id']));
		echo $this->Form->postLink('Flag as Inappropriate', array(), null, __('Are you sure you want to flag this?'));
		echo'<br>';
		echo $this->Html->link('Load an Exhibit', array('controller'=>'usergals','action' => 'load'));
		echo'<br>';
		echo $this->Html->link('Add to your Exhibit', array('controller'=>'treasures','action' => 'index'));		
    echo '</div>';
    ?>

<div class="clear">	</div>
<div class="share-links">
    <div id="fb-root"></div>
    <div class="fb-like" data-href="https://www.facebook.com/centerofthewest" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
    <div class="fb-share-button" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=facebook&utm_campaign=onlinecollections' ?>" data-type="button_count"></div>

    <div class="g-plusone" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=googleplus&utm_campaign=onlinecollections'?>"></div>
    <div style="display: inline-block;"><a href="https://twitter.com/share" class="twitter-share-button" data-via="centerofthewest" data-hashtags="OnlineCollections" data-url="<? echo $TWshorturl;?>">Tweet</a></div>

</div>
<div class="pagging">	
<?php 

		echo 'Page navigation: '.$this->Paginator->numbers(array('modulus'=>15));
		echo '<br />';
		echo $this->Paginator->counter(array('format' => __('{:count} treasures total')));

?>	
</div>       

</div>




<div class="search-results" style="clear:both">

<?php foreach ($treasures as $treasure): ?>
<div class="the-objects">
	<?php				
if(!empty($treasure['Treasure2']['img']))
	echo'<div class="img-block" style="background-image: url(\'//collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$treasure['Treasure2']['img']).'/TileGroup0/0-0-0.jpg\');">';
else
	echo '<div class="img-block" style="background-image: url(\'//collections.centerofthewest.org/img/non.jpg\');">';
			echo '<div class="link">';			
				echo $this->Html->image('transparent.png',array('url'=>array('controller'=>'treasures','action' =>'view', $treasure['Treasure2']['slug'])));
			echo'</div>';
			
			echo '<div class="caption">';
				echo '<div class="txt">';
				if(!empty($treasure['Treasure2']['objtitle']))echo $this->Html->link(substr($treasure['Treasure2']['objtitle'],0,20).'...', array('controller'=>'treasures','action' => 'view', $treasure['Treasure2']['slug']));
				else echo $this->Html->link($treasure['Treasure2']['accnum'], array('controller'=>'treasures','action' => 'view', $treasure['Treasure2']['slug']));
				
				echo'</div>';
				echo '<div class="gal">';				
						if(in_array($treasure['Treasure2']['id'],$Vgals))
						{
							
								//already in pack
								echo '<a id="add" class="invisible" onclick="setCookie(\''.$treasure['Treasure2']['id'].'\');">'.$this->Html->image('add.png',array('id'=>'add')).'</a>';
								echo '<a class="xs" id="remove" onclick="deleteCookie(\''.$treasure['Treasure2']['id'].'\');">'.$this->Html->image('remove.png',array('id'=>'remove')).'</a>';

						}
						else
						{
							//not in pack yet
							echo '<a id="add" class="xs" onclick="setCookie(\''.$treasure['Treasure2']['id'].'\');">'.$this->Html->image('add.png',array('id'=>'add')).'</a>';
							echo '<a class="invisible" id="remove" onclick="deleteCookie(\''.$treasure['Treasure2']['id'].'\');">'.$this->Html->image('remove.png',array('id'=>'remove')).'</a>';				
						}
				echo '</div>';				
			echo '</div>';
echo '</div>'
		?>
		<? echo '<div class="comments">'.$treasure['TreasuresUsergal']['comments'].'</div>';?>
</div>


<?php endforeach; ?>

</div>

<div class="btm-pagging">
<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>

</div>
<div id="post-comments">
    <?php $this->CommentWidget->options(array('allowAnonymousComment' => false));?>
    <?php echo $this->CommentWidget->display();?>
</div>
<div style="margin-top:20px;">&nbsp;</div>
