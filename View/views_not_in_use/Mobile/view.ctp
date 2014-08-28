<?php
	//eventually this can be loaded with AJAX easily as well (if ever necessary)
	
	//page and header declaration
	echo '<div data-role="page" id="page_'.$t['Treasure']['id'].'">';
	echo '<div data-role="header"><h1>'.$t['Treasure']['accnum'].'</h1>';
	echo '</div><!-- /header -->';
	
	//main
	echo '<div role="main" class="ui-content">';
	$img=str_replace(' ','_',str_replace('#','',$t['Treasure']['img']));
	
	//i am just exploding the synopsis because I am working elsewhere
	//then, I just use array keys for elements
	//obviously in real world we'll have to do a bunch of IF
	$tex=explode(" ",$t['Treasure']['synopsis']);
	echo '<h1 class="ui-bar ui-bar-a ui-corner-all">'.$tex[0].' '.$tex[1].'</h1>';
	
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