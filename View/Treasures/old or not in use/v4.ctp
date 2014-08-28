<?php 
$file = file_get_contents("http://remington.centerofthewest.org/zoomify/1/".str_replace(' ','_',$treasure['Treasure']['img'])."/ImageProperties.xml");?>
<script type="text/javascript"> Z.showImage('myContainer', 'http://remington.centerofthewest.org/zoomify/1/<?php echo str_replace(' ','_',$treasure['Treasure']['img']);?>','zImageProperties=<?php echo $file; ?>',"zFullPageVisible=0"); </script>

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
<? echo $this->Html->link('back to Search Results',$backto);	?>
</div>

<div class="neighbors">
<?php 

//debug($treasure);
if  (is_null($neighbors['prev']['Treasure']['slug']) == false) {
echo'<div class="the-arrows">';
echo $this->Html->image('left.png');
echo'</div>';
echo'<div class="the-objects" style="background-image: url(\'http://remington.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$neighbors['prev']['Treasure']['img']).'/TileGroup0/0-0-0.jpg\');">';
echo $this->Html->image('transparent.png',array('url' => array('action' => 'view', $neighbors['prev']['Treasure']['slug']),'width'=>'100','height'=>'100'));  
echo'</div>';
}
echo'<div class="the-objects" style="border:1px solid #bd4f19;background-image: url(\'http://remington.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$treasure['Treasure']['img']).'/TileGroup0/0-0-0.jpg\');">';
echo $this->Html->image('transparent.png',array('width'=>'100','height'=>'100'));  
echo'</div>';


if  (is_null($neighbors['next']['Treasure']['slug']) == false){ 
echo'<div class="the-objects" style="background-image: url(\'http://remington.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$neighbors['next']['Treasure']['img']).'/TileGroup0/0-0-0.jpg\');">';
echo $this->Html->image('transparent.png',array('url' => array('action' => 'view', $neighbors['next']['Treasure']['slug'])));  
echo'</div>';
echo'<div class="the-arrows">';
echo $this->Html->image('right.png');
echo'</div>';

 
 

 }

 ?>
</div>


<div style="clear:both"></div>
<div id="myContainer"></div>

<div class="share-links">
    <div id="fb-root"></div>
    <div class="fb-like" data-href="http://onlinecollections.centerofthewest.org" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>

    <div class="fb-share-button" data-href="<? echo $shorturl;?>" data-type="button"></div>

    <div class="g-plusone"></div>
    <div style="display: inline-block;"><a href="https://twitter.com/share" class="twitter-share-button" data-via="centerofthewest" data-hashtags="OnlineCollections" data-url="<? echo $shorturl;?>">Tweet</a></div>
    <div class="bitly"><textarea rows="1" cols="20"id="bitly" style="font-size:0.7em;resize: none;"><? echo $shorturl;?></textarea></div>

</div>
<div class="clear"></div>

<?php
//read CakeDC Comments readme


?>
<div id="post-comments">
    <?php $this->CommentWidget->options(array('allowAnonymousComment' => false));?>
    <?php echo $this->CommentWidget->display();?>
</div>





<?php 
if (!empty($treasure['Image']))
{
	echo '<div class="related-img">';
	echo '<h2>More Images</h2>';	
	foreach ($treasure['Image'] as $image){
		$file = file_get_contents("http://remington.centerofthewest.org/zoomify/".$image['sortorder']."/".str_replace(' ','_',$image['name'])."/ImageProperties.xml");

echo'<div class="the-related-objects" style="background-image: url(\'http://remington.centerofthewest.org/zoomify/'.$image['sortorder'].'/'.str_replace(' ','_',$image['name']).'/TileGroup0/0-0-0.jpg\');">';
echo'<a href="#" onclick="" onMouseDown="Z.Viewer.setImagePath(\'http://remington.centerofthewest.org/zoomify/'.$image['sortorder'].'/'.str_replace(' ','_',$image['name']).'\')" onTouchStart="Z.Viewer.setImagePath(\'http://remington.centerofthewest.org/zoomify/'.$image['sortorder'].'/'.$image['name'].'\')">'.$this->Html->image('transparent.png',array('width'=>'100','height'=>'100')).'</a></div>';





		
		
	}
echo '</div>';
}?>

<div style="margin-bottom:25px;">&nbsp;</div>