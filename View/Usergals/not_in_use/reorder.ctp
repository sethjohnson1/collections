<?php 
echo $this->Html->script('sj_order');	
echo $this->Js->writeBuffer();
?>
<div class="gallery">
	<?php
    echo'<div class="head">';
		if(!empty($usergal['Usergal']['name']))
			echo '<h2>'.$usergal['Usergal']['name'].'</h2>';
echo '<em>Seths reorder beta</em>';
				
    echo'</div>';	

    ?>

<div class="clear">	</div>

<div class="pagging">	
<?php 

		//debug($eid);
		echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));

?>	
</div>       

</div>




<div class="search-results" style="clear:both">

<?php foreach ($treasures as $k=>$treasure): ?>
<div class="the-objects">
	<?php				
	echo $this->Form->create('Usergal');
	echo $this->Form->input($treasure['Treasure2']['id'],array('type'=>'hidden','class'=>'currentposition','value'=>$k));
echo'<div class="img-block" style="background-image: url(\'http://remington.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$treasure['Treasure2']['img']).'/TileGroup0/0-0-0.jpg\');">';

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
