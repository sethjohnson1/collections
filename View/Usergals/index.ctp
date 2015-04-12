<h2>Virtual Exhibits</h2>

<h3>Check out the virtual exhibits created by others and compare them to your own!</h3>
<div class="makers-search">    
		<?
		echo $this->Form->create('Usergal', array('url' => array_merge(array('action' => 'index'), $this->params['pass'])));

	    echo $this->Form->input('searchall', array('div' => FALSE,'empty'=>true,'label'=>'','placeholder'=>'Search all Fields','class'=>'searchbox'));

		?>
		<div style="clear:both"></div>
	    <div class="notindex submit"><?=$this->Form->submit('/img/glass.png', array('div' => false,'class'=>'vgalsubmit'))?></div>
		<div style="clear:both"></div>
		<?=$this->Form->end()?>	

    <div class="sort-by">	
        <!--p class="header"><?php echo $this->Html->link('Edit your Exhibit', array('action' => 'load'));?></p-->
        <p class="header">Sort By</p>		
        <p><?=$this->Paginator->sort('name').' | '.
        $this->Paginator->sort('creator').' | '.
        $this->Paginator->sort('created').' | '. 
        $this->Paginator->sort('modified')?></p>                
    </div>
</div>

<div class="search-results" style="clear:both;">
	<div style="clear: both"></div>
	<div class="paging">
	
<?
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>	
	</div>  
<?php foreach ($usergals as $usergal): ?>
<div class="the-objects">
	<div class="img-block" style="background-image: url('http://collections.centerofthewest.org/zoomify/1/<?=str_replace(' ','_',$usergal['Usergal']['img'])?>/TileGroup0/0-0-0.jpg')">

			<div class="link">			
				<?=$this->Html->image('transparent.png',array('url'=>array('action' =>'view', $usergal['Usergal']['id'])))?>
			</div>
			
			<div class="caption">
				<div class="txt">
				<? if(strlen($usergal['Usergal']['name'])>20)
					echo $this->Html->link(substr($usergal['Usergal']['name'],0,18).'...', array('action' => 'view', $usergal['Usergal']['id']),array('id'=>'beter-links'));
				else 
					echo $this->Html->link($usergal['Usergal']['name'], array('action' => 'view', $usergal['Usergal']['id']),array('id'=>'beter-links'));
				?>
				<br />
				<?				
				if(strlen($usergal['Usergal']['creator'])>20)
					echo $this->Html->link(substr($usergal['Usergal']['creator'],0,18).'...', array('action' => 'view', $usergal['Usergal']['id']),array('id'=>'beter-links'));
				else 
					echo $this->Html->link($usergal['Usergal']['creator'], array('action' => 'view', $usergal['Usergal']['id']),array('id'=>'beter-links'));
				?>
				<br />
				</div>
				<div class="gal">			
				<!-- not sure why here -->
				</div>			
			</div>
	</div><!-- /imgblock -->
</div><!-- /theobjects -->
<?endforeach ?>

    <div style="margin-top:20px;">&nbsp;</div>
</div>
	<div style="clear: both"></div>
	<div class="paging">
	
<?
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>	
	</div>  
