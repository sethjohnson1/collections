<div class="backto">
<? echo $this->Html->link('back to Search Results',$backto);	?>
</div>
<div class="neighbors">
<?php 
if  (is_null($neighbors['prev']['Treasure']['slug']) == false) {
echo'<div class="the-arrows">';
echo $this->Html->image('left.png');
echo'</div>';

if(!empty($neighbors['prev']['Treasure']['img']))
	echo'<div class="the-objects" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$neighbors['prev']['Treasure']['img']).'/TileGroup0/0-0-0.jpg\');">';
else
	echo'<div class="the-objects" style="background-image: url(\'//collections.centerofthewest.org/img/non.jpg\');">';

echo $this->Html->image('transparent.png',array('url' => array('action' => 'cfmview', $neighbors['prev']['Treasure']['slug']),'width'=>'100','height'=>'100'));  
echo'</div>';
}
if(!empty($treasure['Treasure']['img']))
	echo'<div class="the-objects" style="border:1px solid #bd4f19;background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img'])).'/TileGroup0/0-0-0.jpg\');">';
else
	echo'<div class="the-objects" style="background-image: url(\'//collections.centerofthewest.org/img/non.jpg\');">';

echo $this->Html->image('transparent.png',array('width'=>'100','height'=>'100'));  
echo'</div>';


if  (is_null($neighbors['next']['Treasure']['slug']) == false){ 

if(!empty($neighbors['next']['Treasure']['img']))
	echo'<div class="the-objects" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$neighbors['next']['Treasure']['img']).'/TileGroup0/0-0-0.jpg\');">';
else
	echo'<div class="the-objects" style="background-image: url(\'//collections.centerofthewest.org/img/non.jpg\');">';

echo $this->Html->image('transparent.png',array('url' => array('action' => 'cfmview', $neighbors['next']['Treasure']['slug'])));  
echo'</div>';
echo'<div class="the-arrows">';
echo $this->Html->image('right.png');
echo'</div>';}
?>
</div>
<div class="clear"></div>
<?
if(empty($treasure['Treasure']['img']))
{
	echo '<div id="myContainerCFM">'.$this->html->image('non.jpg',array('id'=>'non')).'</div>';
}
else{
	$file = file_get_contents("http://collections.centerofthewest.org/zoomify/1/".str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img']))."/ImageProperties.xml");
	echo "<script type='text/javascript'> Z.showImage('myContainer', 'http://collections.centerofthewest.org/zoomify/1/".str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img']))."','zImageProperties=".$file."','zFullPageVisible=0'); </script>";
	echo '&nbsp;';
	echo '<div id="myContainer" style="width:940px;"></div>';
}
?>
<div class="clear"></div>
<div class="data">
<? if(!empty($treasure['Location']['name']))echo '<h2><span class="field-name">Location: </span>'.$this->Html->link($treasure['Location']['name'], array('action' => 'index', 'loc:'.$treasure['Location']['name'])).'</h2>';

if(!empty($treasure['Treasure']['objtitle']))echo '<p><span class="field-name">Object name: </span> '. $treasure['Treasure']['objtitle'].'</p>'; 
if(!empty($treasure['Treasure']['accnum']))echo '<p><span class="field-name">Accession Number:</span> '.$treasure['Treasure']['accnum'].'</p>';
if (!empty($treasure['Maker']))
{ 
	echo '<p><span class="field-name">Made by:</span> ';
	
	$numItems = count($treasure['Maker']);
	$i = 0;
	
	foreach ($treasure['Maker'] as $artist) 
	{

		echo $this->Html->link($artist['name'], array('controller' => 'treasures', 'action' => 'index', 'makers'=>$artist['id']));
		if(++$i != $numItems)
			echo ' | ';
	}
	echo'</p>';
}

if (!empty($treasure['Medvalue']))
{
	echo '<p><span class="field-name">Medium : </span>';	
	$numItems = count($treasure['Medvalue']);
	$i = 0;

	foreach ($treasure['Medvalue'] as $tag)
	{
		echo $this->Html->link($tag['name'], array('controller' => 'treasures', 'action' => 'index', 'medvalues'=>$tag['id'])); 
		if(++$i != $numItems)
			echo' | ';
	}
	echo'</p>';}

if(!empty($treasure['Treasure']['daterange']))echo '<p><span class="field-name">Date : </span> '.$treasure['Treasure']['daterange'].'</p>'; 
if(!empty($treasure['Treasure']['gloss']))echo '<p><span class="field-name">Gloss: </span>'.$treasure['Treasure']['gloss'].'</p>';
if(!empty($treasure['Treasure']['dimensions']))echo '<p><span class="field-name">Dimensions: </span>'.$treasure['Treasure']['dimensions'].'</p>';
if(!empty($treasure['Treasure']['creditline']))echo '<p><span class="field-name">Credit Line: </span>'.$treasure['Treasure']['creditline'].'</p>';


if (!empty($treasure['Tag']))
{
	echo'<p style="word-wrap: break-word"><span class="field-name">Tags :</span> ';
	$numItems = count($treasure['Tag']);
	$i = 0;

	foreach ($treasure['Tag'] as $tag)
	{
		echo $this->Html->link($tag['name'], array('controller' => 'treasures', 'action' => 'index', 'tags:'.$tag['name']));
		if(++$i != $numItems)
			echo' | ';
	}
	echo'</p>';
}


if(!empty($treasure['Collection']['name']))
{
	echo '<p><span class="field-name">Collection :</span> ';
	if($treasure['Collection']['name']=='BBM')
		echo $this->Html->link('Buffalo Bill Museum', array('controller' => 'treasures', 'action' => 'index'.'/bbm:1/wg:0/cfm:0/pim:0/dmnh:0/')).'</p>'; 
	if($treasure['Collection']['name']=='WG')
		echo $this->Html->link('Whitney Gallery of Western Art', array('controller' => 'treasures', 'action' =>'index'.'/bbm:0/wg:1/cfm:0/pim:0/dmnh:0/')).'</p>';
	if($treasure['Collection']['name']=='PIM')
		echo $this->Html->link('Plains Indian Museum', array('controller' => 'treasures', 'action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:1/dmnh:0/')).'</p>'; 
	if($treasure['Collection']['name']=='CFM')
		echo $this->Html->link('Cody Firearms Museum', array('controller' => 'treasures', 'action' => 'index'.'/bbm:0/wg:0/cfm:1/pim:0/dmnh:0/')).'</p>'; 
	if($treasure['Collection']['name']=='DMNH')
		echo $this->Html->link('Draper Museum of Natural History', array('controller' => 'treasures', 'action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:0/dmnh:1/')).'</p>'; 								
}
if(!empty($treasure['Treasure']['commonname']))echo '<p><span class="field-name">Common Name: </span>'.$treasure['Treasure']['commonname'].'</p>';
if(!empty($treasure['Treasure']['genus']))echo '<p><span class="field-name">Genus species: </span><i>'.$treasure['Treasure']['genus'].'</i></p>';

if(!empty($treasure['Treasure']['remarks']))echo '<p><span class="field-name">Remarks: </span>'.$treasure['Treasure']['remarks'].'</p>';

if(!empty($treasure['Treasure']['inscription']))echo '<p><span class="field-name">Inscription: </span>'.$treasure['Treasure']['inscription'].'</p>';


if(!empty($treasure['Treasure']['synopsis']))echo '<p><span class="field-name">Synopsis: </span>'.$treasure['Treasure']['synopsis'].'</p>';
//sj break here for CommentPlugin 

//this what the plugin dumps to the view
//debug($commentsData);

//but the plugin itself has layouts in
//  Plugin/Comments/View/Elements for each structure (tree, flat, threaded)
// my tests have found 'tree' to be a good display, but the data is all stored the same
?>

<?php

if(!empty($treasure['Usergal']['0']['TreasuresUsergal']['comments']))
{
echo '<p><span class="field-name">Visitor Comments: </span><br>';
	foreach ($treasure['Usergal'] as $gal)
	{
//$gal['id']
		if(!empty($gal['TreasuresUsergal']['comments']))
		{
			
			echo '<span class="author">From '.$this->Html->link($gal['creator'],array('controller' => 'usergals','action' => 'cfmview', $gal['id'])).'\'s Virtual Exhibit</span>: ';		
			echo $gal['TreasuresUsergal']['comments'].'<br>';			
		}
	}
	
	echo '</p>';
}

//pr($treasure['Usergal']);
 ?>
<div id="post-comments">
    <?php $this->CommentWidget->options(array('allowAnonymousComment' => false));?>
    <?php echo $this->CommentWidget->display();?>
</div>
</div>





<?php 
if (!empty($treasure['Image']))
{
	echo '<div class="related-img" style="width:300px !important">';
	echo '<h2>More Images</h2>';	
	foreach ($treasure['Image'] as $image){
		$file = file_get_contents("http://collections.centerofthewest.org/zoomify/".$image['sortorder']."/".str_replace(' ','_',str_replace('#','',$image['name']))."/ImageProperties.xml");

echo'<div class="the-related-objects" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/'.$image['sortorder'].'/'.str_replace(' ','_',str_replace('#','',$image['name'])).'/TileGroup0/0-0-0.jpg\');">';
echo'<a href="#" onclick="" onMouseDown="Z.Viewer.setImagePath(\'http://collections.centerofthewest.org/zoomify/'.$image['sortorder'].'/'.str_replace(' ','_',str_replace('#','',$image['name'])).'\')" onTouchStart="Z.Viewer.setImagePath(\'http://collections.centerofthewest.org/zoomify/'.$image['sortorder'].'/'.$image['name'].'\')">'.$this->Html->image('transparent.png',array('width'=>'100','height'=>'100')).'</a></div>';





		
		
	}
echo '</div>';
}?>

<div style="margin-bottom:25px;">&nbsp;</div>
<? //debug($commentsData);?>