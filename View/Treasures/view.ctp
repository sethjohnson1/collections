<div class="backto">
<?
	if(in_array($treasure['Treasure']['id'],$Vgals))
	{
		// already in pack
		echo '<a class="invisible" id="add" onclick="setCookie(\''.$treasure['Treasure']['id'].'\');">[Add to Virtual Exhibit]</a>';
		echo '<a class="xs" id="remove" onclick="deleteCookie(\''.$treasure['Treasure']['id'].'\');">[Remove from Virtual Exhibit]</a>';
	}
	else
	{
		//not in pack yet
		echo '<a id="add" class="xs" onclick="setCookie(\''.$treasure['Treasure']['id'].'\');">[Add to Virtual Exhibit]</a>';
		echo '<a class="invisible" id="remove" onclick="deleteCookie(\''.$treasure['Treasure']['id'].'\');">[Remove from Virtual Exhibit]</a>';				
	}
	
?>
<br />
<? 
if (isset($backto)){
echo $this->Html->link('back to Search Results',$backto);
}	
//print_r( $backto);
?>
</div>

<div class="neighbors">
<?php 
if  (is_null($neighbors['prev']['Treasure']['slug']) == false) {
echo'<div class="the-arrows">';

echo $this->Html->image('left.png',array('url' => array('action' => 'view', $neighbors['prev']['Treasure']['slug'])));  
echo'</div>';

if(!empty($neighbors['prev']['Treasure']['img']))
	echo'<div class="the-objects" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$neighbors['prev']['Treasure']['img'])).'/TileGroup0/0-0-0.jpg\');">';
else
	echo'<div class="the-objects" style="background-image: url(\'//collections.centerofthewest.org/img/non.jpg\');">';

echo $this->Html->image('transparent.png',array('url' => array('action' => 'view', $neighbors['prev']['Treasure']['slug']),'width'=>'100','height'=>'100'));  
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
	echo'<div class="the-objects" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$neighbors['next']['Treasure']['img'])).'/TileGroup0/0-0-0.jpg\');">';
else
	echo'<div class="the-objects" style="background-image: url(\'//collections.centerofthewest.org/img/non.jpg\');">';

echo $this->Html->image('transparent.png',array('url' => array('action' => 'view', $neighbors['next']['Treasure']['slug'])));  
echo'</div>';
echo'<div class="the-arrows">';
echo $this->Html->image('right.png',array('url' => array('action' => 'view', $neighbors['next']['Treasure']['slug'])));  
echo'</div>';

 
 

 }

 ?>
</div>


<div style="clear:both"></div>
<?
if(empty($treasure['Treasure']['img']))
{
	echo '<div id="myContainer">'.$this->html->image('non.jpg',array('id'=>'non')).'</div>';
}
else{
	$file = file_get_contents("http://collections.centerofthewest.org/zoomify/1/".str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img']))."/ImageProperties.xml");
	echo '<div id="myContainer"></div>';
}
if(!empty($file))
	echo "<script type='text/javascript'> Z.showImage('myContainer', 'http://collections.centerofthewest.org/zoomify/1/".str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img']))."','zImageProperties=".$file."','zFullPageVisible=0'); </script>";

//Prints Links
if(!empty($treasure['Treasure']['opencartid']))
	echo'<p style="float:left;font-weight:bold;font-size:0.9em"><a href="http://prints.centerofthewest.org/index.php?route=product/product&product_id='.$treasure['Treasure']['opencartid'].'">Purchase a Museum Quality Repoduction</a></p>';

	?>
<div class="share-links">
    <div id="fb-root"></div>
    <div class="fb-like" data-href="https://www.facebook.com/centerofthewest" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>

    <div class="fb-share-button" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=facebook&utm_campaign=onlinecollections' ?>" data-type="button_count"></div>

    <div class="g-plusone" data-href="<? echo $GPshorturl;?>"></div>
    <div style="display: inline-block;"><a href="https://twitter.com/share" class="twitter-share-button" data-via="centerofthewest" data-hashtags="OnlineCollections" data-url="<? echo $TWshorturl;?>">Tweet</a></div>
    <script type="text/javascript" src="//www.reddit.com/static/button/button1.js"></script>
</div>
<div class="clear"></div>
<div class="data">
<?php if(!empty($treasure['Treasure']['objtitle']))echo '<p><span class="field-name">Object name: </span> '. $treasure['Treasure']['objtitle'].'</p>'; 
if(!empty($treasure['Treasure']['accnum']))echo '<p><span class="field-name">Accession Number:</span> '.$treasure['Treasure']['accnum'].'</p>';
if (!empty($treasure['Maker']))
{ 
	echo '<p><span class="field-name">Made by:</span> ';
	
	$numItems = count($treasure['Maker']);
	$i = 0;
	
	foreach ($treasure['Maker'] as $artist) 
	{

		echo $this->Html->link($artist['name'], array('controller' => 'treasures', 'action' => 'index', 'makers'=>$artist['slug']));
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
		echo $this->Html->link($tag['name'], array('controller' => 'treasures', 'action' => 'index', 'medvalues'=>$tag['slug'])); 
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


if(!empty($treasure['Treasure']['collection']))
{
	echo '<p><span class="field-name">Collection:</span> ';
	if($treasure['Treasure']['collection']=='BBM')
		echo $this->Html->link('Buffalo Bill Museum', array('controller' => 'treasures', 'action' => 'index'.'/bbm:1/wg:0/cfm:0/pim:0/dmnh:0/')).'</p>'; 
	if($treasure['Treasure']['collection']=='WG')
		echo $this->Html->link('Whitney Western Art Museum', array('controller' => 'treasures', 'action' =>'index'.'/bbm:0/wg:1/cfm:0/pim:0/dmnh:0/')).'</p>';
	if($treasure['Treasure']['collection']=='PIM')
		echo $this->Html->link('Plains Indian Museum', array('controller' => 'treasures', 'action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:1/dmnh:0/')).'</p>'; 
	if($treasure['Treasure']['collection']=='CFM')
		echo $this->Html->link('Cody Firearms Museum', array('controller' => 'treasures', 'action' => 'index'.'/bbm:0/wg:0/cfm:1/pim:0/dmnh:0/')).'</p>'; 
	if($treasure['Treasure']['collection']=='DMNH')
		echo $this->Html->link('Draper Natural History Museum', array('controller' => 'treasures', 'action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:0/dmnh:1/')).'</p>'; 								
}

if(!empty($treasure['Treasure']['location']))
{
	$arr = explode(".", $treasure['Treasure']['location'], 2);
	if($arr[0]=='PIM')
		echo '<p><span class="field-name">Location: </span>'.$this->Html->link('Plains Indian Museum', array('action' => 'index', 'loc:'.$arr[0])).'</p>';
	if($arr[0]=='DMNH')
		echo '<p><span class="field-name">Location: </span>'.$this->Html->link('Draper Natural History Museum', array('action' => 'index', 'loc:'.$arr[0])).'</p>';
	if($arr[0]=='CFM')
		echo '<p><span class="field-name">Location: </span>'.$this->Html->link('Cody Firearms Museum', array('action' => 'index', 'loc:'.$arr[0])).'</p>';
	if($arr[0]=='BBM')
		echo '<p><span class="field-name">Location: </span>'.$this->Html->link('Buffalo Bill Museum', array('action' => 'index', 'loc:'.$arr[0])).'</p>';
	if($arr[0]=='WG')
		echo '<p><span class="field-name">Location: </span>'.$this->Html->link('Whitney Western Art Museum', array('action' => 'index', 'loc:'.$arr[0])).'</p>';	
}


if(!empty($treasure['Treasure']['commonname']))echo '<p><span class="field-name">Common Name: </span>'.$treasure['Treasure']['commonname'].'</p>';
if(!empty($treasure['Treasure']['taxonomic']))echo '<p><span class="field-name">Taxonomic: </span>'.$treasure['Treasure']['taxonomic'].'</p>';
if(!empty($treasure['Treasure']['genus']))echo '<p><span class="field-name">Genus species: </span><i>'.$treasure['Treasure']['genus'].'</i></p>';

if(!empty($treasure['Treasure']['remarks']))echo '<p><span class="field-name">Remarks: </span>'.$treasure['Treasure']['remarks'].'</p>';

if(!empty($treasure['Treasure']['inscription']))echo '<p><span class="field-name">Inscription: </span>'.$treasure['Treasure']['inscription'].'</p>';


if(!empty($treasure['Treasure']['synopsis']))echo '<p><span class="field-name">Synopsis: </span>'.$treasure['Treasure']['synopsis'].'</p>';
/*Related Relations Section*/
if(!empty($treasure['Relation'])){
echo '<h3 style="margin:5px 0px 10px 0px;">Related Content</h3>';
	foreach ($treasure['Relation'] as $article){
		$strJson = @file_get_contents('http://centerofthewest.org/wp-json/posts/'.$article['blogid'].'/');
		$arrJson = json_decode($strJson,true);
		if(!empty($arrJson['featured_image']['source'])){
			echo '<p><a href="'.$arrJson['link'].'">'.$arrJson['title'].'</a> - By '.$arrJson['author']['name'];
			echo '<br/><a href="'.$arrJson['link'].'" style="background-color:#ede9e7;display: block;width: 50%;position: relative;height: 0;padding: 20% 0 0 0;overflow: hidden;float:left;"><img src="'.$arrJson['featured_image']['source'].'"style="position: absolute;display: block;max-width: 100%;max-height: 100%;left: 0;right: 0;top: 0;bottom: 0;margin: auto;"></a>';
			echo strip_tags(substr($arrJson['content'],0,150)).'...<br><a href="'.$arrJson['link'].'" class="">&#x25ba; Read More</a>';		
			
		}
		else
		{
			echo '<p>Invalid POST ID</p>';
		//	break;
		}
		echo '</p><hr style="clear:both;">';
	}
}
/*Related Relations Section*/

//sj break here for CommentPlugin 

//this what the plugin dumps to the view
//debug($commentsData);

//but the plugin itself has layouts in
//  Plugin/Comments/View/Elements for each structure (tree, flat, threaded)
// my tests have found 'tree' to be a good display, but the data is all stored the same
?>

<?php
//debug($treasure);
if(!empty($treasure['Usergal']))
{
echo '<h3 style="margin:5px 0px 10px 0px;">Virtual Galleries</h3><p>';
	foreach ($treasure['Usergal'] as $gal)
	{
		$img_link='http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$gal['img'])).'/TileGroup0/0-0-0.jpg';
			echo '<p>';
			echo $this->Html->link($gal['name'],array('controller' => 'usergals','action' => 'view', $gal['id'])).' - Curated by: '.$gal['creator'];
			//<a href="'..'">'.$arrJson['title'].'</a> - By '.$arrJson['author']['name'];
			//not using cakePHP convention here.. Probably should at some point
			echo '<br/>';

			echo '<a href="http://collections.centerofthewest.org/usergals/view/'.$gal['id'].'" style="background-color:#ede9e7;display: block;width: 50%;position: relative;height: 0;padding: 20% 0 0 0;overflow: hidden;float:left;"><img src="'.$img_link.'"style="position: absolute;display: block;max-width: 100%;max-height: 100%;left: 0;right: 0;top: 0;bottom: 0;margin: auto;"></a>';
			//echo strip_tags(substr($arrJson['content'],0,150)).'...<br><a href="'.$arrJson['link'].'" class="">&#x25ba; Read More</a>';	
			
			echo '</p>';
//debug($gal);
		if(!empty($gal['TreasuresUsergal']['comments']))
		{
			//echo '<span class="author">From '.$this->Html->link($gal['creator'],array('controller' => 'usergals','action' => 'view', $gal['id'])).'\'s Virtual Exhibit</span>: ';		
			echo $gal['TreasuresUsergal']['comments'].'<br />';		
		}
		echo '<hr style="clear:both;">';
	}
	
	echo '</p><br style="clear:both;">';
}

//this was for the beginning of an AJAX login. It worked sort of but kept redirecting so I commented out
//echo ' <button id="login-button">Login</button>';
 ?>


<div id="post-comments">
    <?php $this->CommentWidget->options(array('allowAnonymousComment' => false));?>
    <?php echo $this->CommentWidget->display();?>
</div>
</div>
<?    $this->Js->get('#login-button')->event(
            'click', $this->Js->request(
                    array('plugin'=>'users','controller' => 'users', 'action' => 'login'), array(
                'update' => '#post-comments',
                'async' => true,
                    )
            )
    );
    
	echo $this->Js->writeBuffer();

?>


<?php 
if (!empty($treasure['Image']))
{
	echo '<div class="related-img">';
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