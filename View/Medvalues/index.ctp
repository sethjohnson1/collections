<div class="medium-search">
		<?php
		echo $this->Form->create('Medvalue');
	    echo $this->Form->input('name', array('div' => true,'placeholder'=>'Search Medium','empty'=>true,'label'=>false,'type'=>'text','class'=>'searchbox'));	    
		?>		


<div class="notindex-paging">
<?php 

		echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
		echo $this->Form->input('pXv_9g', array('class'=>'pagenum','div' => false,'empty'=>true,'label'=>'Page ','default'=>$this->params['paging']['Medvalue']['page']));	 
		echo $this->Paginator->counter(array('format' => __(' of {:pages} ')));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
echo'<div style="clear:both"></div>';
	    echo '<div class="notindex submit">'.$this->Form->submit('/img/glass.png', array('div' => false)).'</div>';
		echo'<div style="clear:both"></div>';
		echo '<div class="results">'.$this->Form->input('n',array('div'=>false,'options'=>array(25=>25,50=>50,75=>75,100=>100),'default'=>$limit,'label'=>'Results per Page ','onchange'=>'this.form.submit()')).'</div>';
		echo $this->Form->end();
		echo $this->Js->writeBuffer();	
		
?>	
</div>       
</div>
<div style="clear:both"></div>
<div class="search-results">
<?php foreach ($medvalues as $medvalue): ?>
<div class="the-objects">
	<?php			

$md = preg_replace("/[^ \w]+/", "", $medvalue['Medvalue']['name']);	
echo'<div class="img-block" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$medvalue['Medvalue']['img']).'/TileGroup0/0-0-0.jpg\');">';

			echo '<div class="link">';			
				echo $this->Html->image('transparent.png',array('onclick'=>'medvalCook(\''.$md.'\')','url' => array('controller' => 'treasures', 'action' => 'index', 'medvalues'=>$medvalue['Medvalue']['slug'])));
			echo'</div>';
			
			echo '<div class="caption">';

			echo '<div class="txt">';
    
				if(strlen($medvalue['Medvalue']['name'])>=39)
					echo $this->Html->link(substr($medvalue['Medvalue']['name'],0,38).'...',array('controller' => 'treasures', 'action' => 'index','medvalues'=>$medvalue['Medvalue']['id']),array('onclick'=>'medvalCook(\''.$md.'\')'));
				else
					echo $this->Html->link($medvalue['Medvalue']['name'],array('controller' => 'treasures', 'action' => 'index','medvalues'=>$medvalue['Medvalue']['id']),array('onclick'=>'medvalCook(\''.$md.'\')'));

                   
			
            echo'</div>';
	echo '</div>';
echo '</div>';
		
echo '</div>';?>


<?php endforeach; ?>
    
<div class="btm-pagging">
<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>

</div>
    
</div>



