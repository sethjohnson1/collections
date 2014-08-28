<?php

/* This was my first attempt, just a simple loop through Controller data 
I have kept it as a reference to page building - although the new index doesn't use it at all 
its all commented out at the bottom

*/

//begin json autocomplete test

//really need to go through and fix up breaking in and out of PHP...

echo '<div data-role="page" id="main">';
echo '<div data-role="header">';
echo '<h1 class="ui-bar ui-bar-a ui-corner-all">Center of the West Treasures</h1>';

//echo $this->Html->link('Dialog',array('action'=>'dialog'),array('data-rel'=>'dialog'));
echo '</div>';

//main
echo '<div role="main" class="ui-content">';

/* regular checkbox always showed on.. tried select flipswitch instead
echo '<form>';
echo '<label for="flip-checkbox-1">Only items on display</label>';
echo '<input type="checkbox" data-role="flipswitch" name="flip-checkbox-1" id="flip-checkbox-1">';
echo '</form>';
*/

echo ' <label for="flip-select">Show only items on display:</label>
    <select id="flip-select" name="flip-select" data-role="flipswitch">
        <option>Off</option>
        <option>On</option>
    </select>';

echo '
<ul id="autocomplete" data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Synopsis . . ." data-filter-theme="a"></ul>';
echo '</div>';


	echo '<div data-role="footer">';
	echo '<h4>Center of the West</h4>';
	echo '</div><!-- /footer -->';
//end main page div
echo '</div>';

/* OLD just results, but very handy to see page creation, we can use this on view, now the Controller does NO find here


echo $this->Form->create('filter',array('class'=>'ui-filterable'));
echo $this->Form->input('hey',array('id'=>'filterBasic-input','label'=>false,'method'=>false,'action'=>false));
echo $this->Form->end();


echo '<ul data-role="listview" data-filter="true" data-input="#filterBasic-input">';
foreach ($treasures as $t){
echo '<li>'.$this->Html->image('http://remington.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$t['Treasure']['img'])).'/TileGroup0/0-0-0.jpg',array('alt'=>'thumbnail','url'=>array(
'action'=>'#page_'.$t['Treasure']['id']))).' '.$t['Treasure']['accnum'].'</li>';
}
echo '</ul>';

//now testing for JSON autocomplete



foreach ($treasures as $t){
	//page and header declaration
	echo '<div data-role="page" id="page_'.$t['Treasure']['id'].'">';
	echo '<div data-role="header"><h1>'.$t['Treasure']['accnum'].'</h1>';
	echo '</div><!-- /header -->';
	
	//main
	echo '<div role="main" class="ui-content">';
	$img=str_replace(' ','_',str_replace('#','',$t['Treasure']['img']));
	echo $this->Html->image('http://remington.centerofthewest.org/zoomify/1/'.$img.'/TileGroup0/0-0-0.jpg');
//	'http://remington.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img'])).'/TileGroup0/0-0-0.jpg\');">';
	echo '<p>'.$t['Treasure']['synopsis'].'</p>';
	echo '<form>';
	echo '<label for="slider-2">Love-O-Meter</label>';
	echo '<input type="range" name="slider-2" id="loveMeter" data-highlight="true" min="0" max="100" value="50">';
	echo '</form>';
	echo '</div><!-- /content -->';
	
	//footer
	echo '<div data-role="footer">';
	echo $this->Html->link('Go Back',array('action'=>'#main'));
	echo '<h4>Center of the West</h4>';
	echo '</div><!-- /footer -->';
	echo '</div><!-- /page -->';	
}



echo $this->Html->link('Open Dialog',array('action'=>'dialog','data-transition'=>'pop'));

//debug($treasures);
*/