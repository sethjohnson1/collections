<div class="treasure-search">
	<?php
		echo $this->Form->create('Treasure');
	    echo $this->Form->input('searchall', array('div' => FALSE,'empty'=>true,'label'=>'','placeholder'=>'Search all Fields')); 
	    echo $this->Form->submit('/img/glass.png', array('div' => true));	
        echo $this->Form->end();
		echo $this->Html->script('sj_autocp1');
		echo $this->Js->writeBuffer();
	?>
</div>
<div class="pagging" style="float:left">	<?php 
echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}')));
echo '&nbsp;&nbsp;&nbsp;'.$this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));?>	
</div>   

<div style="float:right"><?php echo $this->Paginator->counter(array('format' => __('Showing {:current} records out of {:count}')));?></div>
<div class="clear"></div>
<div class="search-results">
<?php foreach ($treasures as $treasure): ?>
<div class="the-objects">
	<?php				
if(!empty($treasure['Treasure']['img']))
	echo'<div class="img-block" style="background-image: url(\'http://remington.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img'])).'/TileGroup0/0-0-0.jpg\');">';
else
	echo'<div class="img-block" style="background-image: url(\'http://oc.bbhclan.org/img/non.jpg\');">';	

			echo '<div class="link">';			
				echo $this->Html->image('transparent.png',array('url'=>array('action' =>'cfmview', $treasure['Treasure']['slug'])));
			echo'</div>';
			
			echo '<div class="caption">';
				echo '<div class="txt">';
				
			//seth wrapped in bigger IF for Draper
			 if ($treasure['Collection']['name']!='DMNH'){
				if(!empty($treasure['Treasure']['objtitle']))
				{
					if(strlen($treasure['Treasure']['objtitle'])>=16)
						echo $this->Html->link(substr($treasure['Treasure']['objtitle'],0,15).'...', array('action' => 'view', $treasure['Treasure']['slug']));
					else
						echo $this->Html->link($treasure['Treasure']['objtitle'], array('action' => 'view', $treasure['Treasure']['slug']));
					
				}
				else echo $this->Html->link($treasure['Treasure']['accnum'], array('action' => 'view', $treasure['Treasure']['slug']));
				}
			else {
				if(!empty($treasure['Treasure']['commonname']))
				{
					if(strlen($treasure['Treasure']['commonname'])>=16)
						echo $this->Html->link(substr($treasure['Treasure']['commonname'],0,15).'...', array('action' => 'view', $treasure['Treasure']['slug']));
					else
						echo $this->Html->link($treasure['Treasure']['commonname'], array('action' => 'view', $treasure['Treasure']['slug']));
				}
				else echo $this->Html->link($treasure['Treasure']['accnum'], array('action' => 'view', $treasure['Treasure']['slug']));
			}
				
				$i=0;
				$caption='';
				echo '<br>';
				//seth wrapped whole thing in bigger IF for Draper.
				if (!empty($treasure['Maker'])){
						foreach ($treasure['Maker'] as $val)
						{
							if(!empty($val['name']))
							{
								if($i >= 3)
									break;
								else
								{
									if(strlen($val['name'])>=26)//this checks if what its about to output if its to big then just write it down use the max length and then quit the loop and echo
									{									
										$caption .= $val['name'];
										break;										
									}
									else
									{
										$caption .= $val['name'];
										if($i < 3)//checks if its not this is the last loop only reason to add a pipe
											$caption .= '|';
										
									}
								}
								$i++;
								//echo '</span>';
								
								
							}	
						}
					if(strlen($caption)>=21)
					{												
						echo '<span class="med">'.substr($caption,0,20).'...</span>';						
					}
					else
					{
						if(substr($caption,-1)=="|")
							echo '<span class="med">'.rtrim($caption,'|').'</span>';
						else if(substr($caption,-1)==",")
							echo '<span class="med">'.rtrim($caption,',').'</span>';

						else
							echo '<span class="med">'.$caption.'</span>';
					}
				}
				else {
					if(!empty($treasure['Treasure']['genus'])) {
						echo '<span class="med">';
						echo $treasure['Treasure']['genus'];
						echo '</span>';
					}
				}

				
				echo'</div>';
			echo '</div>';
echo '</div>';?>
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

<div style="margin-top:20px;">&nbsp;</div>