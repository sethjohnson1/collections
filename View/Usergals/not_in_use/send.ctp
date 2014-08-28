<?php

echo $this->Form->create('myStuff',array('div'=>true,'default'=>false));
//add 'default'=>false for AJAX submit

echo $this->Form->input('mystuff');		
echo $this->Form->input('results',array('label'=>false,'class'=>'results'));		
echo $this->Form->submit('Submit', array('div' => false));	

echo '<div class="results" id="resultField" style="height: 50px; width:auto; border: 1px solid gray; font-size:1.2em;"></div>';
		
//echo $this->Js->submit('Save', array());
//$this->Js->get('.basic-results');
//$this->Js->sortable(array('cursor'=>'move'));
echo '<div id="all-buckets">';

echo '<div id="bucket_1" style="clear:both; float: left; border: 1px solid black; min-height:100px; min-width:100px;">';
//debug($usergals);
foreach ($treasures as $key=>$val){

	echo '<div id="field_'.$val['Treasure']['id'].'">';
	echo '<img src="http://remington.centerofthewest.org/zoomify/1/'.$val['Treasure']['img'].'/TileGroup0/0-0-0.jpg">';
	echo $this->Form->input('myStuff.col.'.$val['Treasure']['id'],array('type'=>'hidden','class'=>'collection','value'=>'Unmoved','id'=>'TreasureHunt_'.$val['Treasure']['id']));
	
	echo '</div>';
}


echo '</div>';

echo '<div id="bucket_2" style="float: left; border: 1px solid purple; padding: 10px; min-height:100px; min-width:100px;">';

echo '</div>';

//end all-buckets DIV
echo '</div>';




echo $this->Html->script('sj_ajax1');
echo $this->Form->end();
echo $this->Js->writeBuffer();

?>