<?php

echo $this->Form->create('Treasure',array('div'=>true,'default'=>false));

echo $this->Js->submit('Save', array('url'=>'respond.json'));

$this->Js->get('.basic-results');
$this->Js->sortable(array('cursor'=>'move'));

echo '<div class="basic-results" style="clear:both">';

foreach ($treasures as $key=>$treasure){

	echo '<div>'.$treasure['Treasure']['id'];

		echo $this->Form->input('Usergal.sortord2.'.$treasure['Treasure']['id'],array('type'=>'hidden','class'=>'currentposition','value'=>$key,'id'=>'UsergalComments_'.$treasure['Treasure']['id']));
	
	echo '</div>';
}


echo '</div>';


echo $this->Form->end(); 
echo $this->Js->writeBuffer();?>