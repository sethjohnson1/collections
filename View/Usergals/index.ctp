<h2>Virtual Exhibits</h2>

<h3>Check out the virtual exhibits created by others and compare them to your own!</h3>
<div class="virtual-exhibits-search">    
		<?
		echo $this->Form->create('Usergal', array('url' => array_merge(array('action' => 'index'), $this->params['pass'])));

	    echo $this->Form->input('searchall', array('div' => FALSE,'empty'=>true,'label'=>'','placeholder'=>'Search all Fields'));

		echo'<div style="clear:both"></div>';
	    echo '<div class="maglass">'.$this->Form->submit('/img/glass.png', array('div' => false)).'</div>';
		echo'<div style="clear:both"></div>';
		echo $this->Form->end();
		
?>	

    <div class="sort-by">	
        <p class="header"><?php echo $this->Html->link('Edit your Exhibit', array('action' => 'load'));?></p>
        <p class="header">Sort By</p>		
        <p><?php echo $this->Paginator->sort('name'); ?></p>
        <p><?php echo $this->Paginator->sort('creator'); ?></p>
        <p><?php echo $this->Paginator->sort('created'); ?></p>        
        <p><?php echo $this->Paginator->sort('modified'); ?></p>                
        
    </div>
    
</div>
    <div class="search-results" style="clear:both;position:relative;top:-72px;">
<?php foreach ($usergals as $usergal): ?>
<div class="the-objects">
	<?php				
echo'<div class="img-block" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$usergal['Usergal']['img']).'/TileGroup0/0-0-0.jpg\');">';

			echo '<div class="link">';			
				echo $this->Html->image('transparent.png',array('url'=>array('action' =>'view', $usergal['Usergal']['id'])));
			echo'</div>';
			
			echo '<div class="caption">';
				echo '<div class="txt">';
				if(strlen($usergal['Usergal']['name'])>20)
					echo $this->Html->link(substr($usergal['Usergal']['name'],0,18).'...', array('action' => 'view', $usergal['Usergal']['id']),array('id'=>'beter-links'));
				else 
					echo $this->Html->link($usergal['Usergal']['name'], array('action' => 'view', $usergal['Usergal']['id']),array('id'=>'beter-links'));
				echo'<br>';	
				if(strlen($usergal['Usergal']['creator'])>20)
					echo $this->Html->link(substr($usergal['Usergal']['creator'],0,18).'...', array('action' => 'view', $usergal['Usergal']['id']),array('id'=>'beter-links'));
				else 
					echo $this->Html->link($usergal['Usergal']['creator'], array('action' => 'view', $usergal['Usergal']['id']),array('id'=>'beter-links'));

				echo '<br>';
				
				echo'</div>';
				echo '<div class="gal">';				

				echo '</div>';				
			echo '</div>';
echo '</div>'?>
</div>
<?php endforeach; ?>

    	<div style="margin-top:20px;">&nbsp;</div>
	</div>
