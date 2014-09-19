<h2><?php echo __('Makers'); ?></h2>
<div class="makers-search">
	<?php
    	echo $this->Form->create('Maker');
	    echo $this->Form->input('name', array('div' => true,'label'=>false,'type'=>'text','placeholder'=>'Search for Makers'));	 
	?>




<div class="maker-paging">
<?php 

		echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
		echo $this->Form->input('pXv_9g', array('div' => false,'empty'=>true,'label'=>'Page ','default'=>$this->params['paging']['Maker']['page']));	 
		echo $this->Paginator->counter(array('format' => __(' of {:pages} ')));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		echo'<div style="clear:both"></div>';
	    echo '<div class="maglass">'.$this->Form->submit('/img/glass.png', array('div' => false)).'</div>';
		echo'<div style="clear:both"></div>';
		echo '<div class="results">'.$this->Form->input('n',array('div'=>false,'options'=>array(25=>25,50=>50,75=>75,100=>100),'default'=>$limit,'label'=>'Results per Page ','onchange'=>'this.form.submit()')).'</div>';
		echo $this->Form->end();
//		echo $this->Js->writeBuffer();	
		
?>	
</div>   
</div>    
<div style="clear:both"></div>
<div class="search-results">
<?php foreach ($makers as $maker): ?>
<div class="the-objects">
	<?php				
echo'<div class="img-block" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$maker['Maker']['img']).'/TileGroup0/0-0-0.jpg\');">';
//have to use a cookie for maker name, better for performance anyway
$mk = preg_replace("/[^ \w]+/", "", $maker['Maker']['name']);
			echo '<div class="link">';			
				echo $this->Html->image('transparent.png',array('onclick'=>'makerCook(\''.$mk.'\')','url'=>array('controller'=>'treasures','action' => 'index','makers'=>$maker['Maker']['slug'])));
			echo'</div>';
			
			echo '<div class="caption">';

				echo '<div class="txt">';
				{
					if(strlen($maker['Maker']['name'])>=39)
						echo $this->Html->link(substr($maker['Maker']['name'],0,38).'...', array('controller'=>'treasures','action' => 'index','makers'=>$maker['Maker']['id']),array('onclick'=>'makerCook(\''.$mk.'\')'));
					else
						echo $this->Html->link($maker['Maker']['name'], array('controller'=>'treasures','action' => 'index','makers'=>$maker['Maker']['id']),array('onclick'=>'makerCook(\''.$mk.'\')'));

				}
			
            echo'</div>';
	echo '</div>';
echo '</div>';
		
echo '</div>';?>
<?php endforeach; ?>
</div>
<div class="btm-pagging">
<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>

</div>
<div style="margin-top:20px;">&nbsp;</div>



