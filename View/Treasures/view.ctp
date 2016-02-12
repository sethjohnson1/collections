<?
//first set count for filled record completeness, initially add some value based on relations, then add as we go
$filled=0;
$possible=18;
if (!empty($treasure['Usergal'])) $filled++;
if (!empty($treasure['Relation'])) $filled++;
if (!empty($treasure['Maker'])) $filled++;
if (!empty($treasure['Medvalue'])) $filled++;
//make link to self if Ajax
if (isset($ajax)):?>
<div style="padding: 0 10px">
<?
if (!empty($ajax['TreasuresUsergal']['comments'])) echo '<h4>"'.$ajax['TreasuresUsergal']['comments'].'"</h4>';
echo $this->Html->link('Visit record &raquo;',array(),array('escape'=>false)).'<br />';
//also skip a lot if Ajax is set...
?>
</div>
<?
else:

?>


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

?>
<div class="hidden-xs">
<?
if(empty($treasure['Treasure']['img']))
{
	echo '<div id="myContainer">'.$this->html->image('non.jpg',array('id'=>'non')).'</div>';
}
else{
	$file = file_get_contents("http://collections.centerofthewest.org/zoomify/1/".str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img']))."/ImageProperties.xml");
	$file=str_replace('"',"'",$file);
	/* Zoomify 3 doesn't work because of the ".JPG" at the end of the path, not much we can do about that at the moment so just moving on for now - sj - this was fixed but still problems with Zoomify3 */

}
if(!empty($file)):?>
	<script type='text/javascript'> Z.showImage("myContainer", "http://collections.centerofthewest.org/zoomify/1/<?=str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img']))?>","zFullViewVisible=0","zImageProperties=<?=$file?>","zFullPageVisible=0","zFullViewVisible=0"); 
	</script>
<div id="myContainer"></div>

	<?
	else :?>
	<h1>Our apologies.<small>We're having trouble loading this image. <?=$this->Html->link('Click here',array('controller'=>'treasures','action'=>'about','#'=>'feedback','?'=>array('zimg'=>urlencode('http://'.$_SERVER['HTTP_HOST'].$this->here))))?> to let us know about it and we'll try to fix it.</small></h1>
	<?
	endif;

//Prints Links - sj removed this web site is not long for this world
/*
if(!empty($treasure['Treasure']['opencartid']))
	echo'<p style="float:left;font-weight:bold;font-size:0.9em"><a href="http://prints.centerofthewest.org/index.php?route=product/product&product_id='.$treasure['Treasure']['opencartid'].'">Purchase a Museum Quality Reproduction</a></p>';
	*/
if (count($treasure['Image'])>1):?>

<div class="related-img">
<?	
	foreach ($treasure['Image'] as $image):
		//this is a completely worthless waste of load time
		//$file = file_get_contents("http://collections.centerofthewest.org/zoomify/".$image['sortorder']."/".str_replace(' ','_',str_replace('#','',$image['name']))."/ImageProperties.xml");?>

	<div class="the-related-objects" style="background-image: url('http://collections.centerofthewest.org/zoomify/<?=$image['sortorder'].'/'.str_replace(' ','_',str_replace('#','',$image['name']))?>/TileGroup0/0-0-0.jpg');">
	
	<a href="#" onclick="" onMouseDown="Z.Viewer.setImagePath('http://collections.centerofthewest.org/zoomify/<?=$image['sortorder'].'/'.str_replace(' ','_',str_replace('#','',$image['name']))?>')" onTouchStart="Z.Viewer.setImagePath('http://collections.centerofthewest.org/zoomify/<?=$image['sortorder'].'/'.$image['name']?>')"><?=$this->Html->image('transparent.png',array('width'=>'100','height'=>'100'))?></a></div>
	
	<?endforeach?>
</div>
<?endif?>
</div><!-- hidden-xs -->
<?endif //hidden from ajax?>
<? //the ajax call this is still hidden, so we remove the class
$mclass='visible-xs-inline row mobile-img-container';
if (isset($ajax))$mclass='';
?>
<div id="" class="<?=$mclass?>">
<div class=" col-xs-12">
<?
$img='http://collectionimages.s3-website-us-west-1.amazonaws.com/1/'.urlencode(str_replace(' ','_',$treasure['Treasure']['img']));
?>
<a href="<?=$img?>">
<script>
//simple show div for missing image
function missingImg(src) {
	$('.missing-mobile-img-message').fadeIn();
}

</script>
<img src="<?=$img?>" class="img-responsive" onerror="missingImg('<?=$img?>')"></a>

<div class="missing-mobile-img-message" style="display:none;">
<h1>Our apologies. <small>We're having trouble loading this image. <?=$this->Html->link('Click here',array('controller'=>'treasures','action'=>'about','#'=>'feedback','?'=>array('mimg'=>urlencode('http://'.$_SERVER['HTTP_HOST'].$this->here))))?> to let us know about it and we'll try to fix it.</small></h1>
</div>
</div>
</div> <!-- /mobileview -->



<div class="clear"></div>
<div class="info-container">
<div class="row">

<script>
$('.badge-hov').hover(function(e) {
    $('span.badge-hov').trigger(e.type);
});

</script>
<div class="col-sm-4 col-sm-push-8">
<div class="row">
<?if(!empty($treasure['Treasure']['collection'])):?>

<div class="col-sm-12">

<h3>Collection</h3>
<p>
<?
$svg='svg';
//conditional IE statement for it's terrible, shameful SVG support. Trident is IE 11. 
if (isset($_SERVER['HTTP_USER_AGENT']) &&
    ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) || strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false)) {   
     $svg='png';
    }
	if($treasure['Treasure']['collection']=='BBM')
		echo $this->Html->link(
		$this->Html->image('icons/bbm.'.$svg,array('alt'=>'Buffalo Bill Museum','class'=>'img-responsive','onerror'=>'this.src=\'/img/icons/bbm.png\'; this.onerror=null;')),
		array('controller' => 'treasures', 'action' => 'index'.'/bbm:1/wg:0/cfm:0/pim:0/dmnh:0/'),array('escape'=>false));
		
	if($treasure['Treasure']['collection']=='WG')
		echo $this->Html->link($this->Html->image('icons/wg.'.$svg,array('alt'=>'Whitney Western Art Museum','class'=>'img-responsive','onerror'=>'this.src=\'/img/icons/wg.png\'; this.onerror=null;')), array('controller' => 'treasures', 'action' =>'index'.'/bbm:0/wg:1/cfm:0/pim:0/dmnh:0/'),array('escape'=>false));
	
	if($treasure['Treasure']['collection']=='PIM')
		echo $this->Html->link($this->Html->image('icons/pim.'.$svg,array('alt'=>'Plains Indian Museum','class'=>'img-responsive','onerror'=>'this.src=\'/img/icons/pim.png\'; this.onerror=null;')), array('controller' => 'treasures', 'action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:1/dmnh:0/'),array('escape'=>false)); 
	
	if($treasure['Treasure']['collection']=='CFM')
		echo $this->Html->link($this->Html->image('icons/cfm.'.$svg,array('alt'=>'Cody Firearms Museum','class'=>'img-responsive','onerror'=>'this.src=\'/img/icons/cfm.png\'; this.onerror=null;')), array('controller' => 'treasures', 'action' => 'index'.'/bbm:0/wg:0/cfm:1/pim:0/dmnh:0/'),array('escape'=>false)); 
	
	if($treasure['Treasure']['collection']=='DMNH')
		echo $this->Html->link($this->Html->image('icons/dmnh.'.$svg,array('alt'=>'Draper Natural History Museum','class'=>'img-responsive','onerror'=>'this.src=\'/img/icons/dmnh.png\'; this.onerror=null;')), array('controller' => 'treasures', 'action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:0/dmnh:1/'),array('escape'=>false));							
?>
</p>
</div>
<?endif?>

<?if (!empty($treasure['Maker'])):
?>
<div class="col-sm-12">
<h3>Made by</h3>

<?
	$numItems = count($treasure['Maker']);
	$i = 0;
	foreach ($treasure['Maker'] as $artist):?>
	<div class="badge-hov">
	<?
	if ($artist['num']>1){
		$mk = preg_replace("/[^ \w]+/", "", $artist['name']);
		$badge=' <span class="badge">'.$artist['num'].'</span>';
		echo $this->Html->link($artist['name'].$badge, array('controller' => 'treasures', 'action' => 'index', 'makers'=>$artist['slug']),array('class'=>'badge-hov','onclick'=>'makerCook(\''.$mk.'\')','escape'=>false));
	}
	else echo $artist['name'];
	if(++$i != $numItems) echo ' <br /> ';?>
	</div>
	<?endforeach?>

</div>
<?endif?>

<?if (!empty($treasure['Medvalue'])):
?>
<div class="col-sm-12">
	<h3>Medium</h3>
<?
	$numItems = count($treasure['Medvalue']);
	$i = 0;

	foreach ($treasure['Medvalue'] as $tag):?>
	<div class="badge-hov">
	<?if ($tag['num']>1){
		$mk = preg_replace("/[^ \w]+/", "", $tag['name']);
		$badge=' <span class="badge">'.$tag['num'].'</span>';
		echo $this->Html->link($tag['name'].$badge, array('controller' => 'treasures', 'action' => 'index', 'medvalues'=>$tag['slug']),array('escape'=>false,'onclick'=>'medvalCook(\''.$mk.'\')'));
	}
	else echo $tag['name'];
	if(++$i != $numItems) echo' - ';?>
	</div>
	<?endforeach?>
</div>
<?endif?>
<div class="col-sm-12">
<h3>Location</h3>
<?
$loctxt='<em>Not currently on display</em>';
if(!empty($treasure['Treasure']['location'])){

	$arr = explode(".", $treasure['Treasure']['location'], 2);
	if($arr[0]=='PIM'){
		$loctxt=$this->Html->link('Plains Indian Museum', array('action' => 'index', 'loc:'.$arr[0]));}
	if($arr[0]=='DMNH'){
		$loctxt=$this->Html->link('Draper Natural History Museum', array('action' => 'index', 'loc:'.$arr[0]));}
	if($arr[0]=='CFM'){
		$loctxt=$this->Html->link('Cody Firearms Museum', array('action' => 'index', 'loc:'.$arr[0]));}
	if($arr[0]=='BBM'){
		$loctxt=$this->Html->link('Buffalo Bill Museum', array('action' => 'index', 'loc:'.$arr[0]));}
	if($arr[0]=='WG'){
		$loctxt=$this->Html->link('Whitney Western Art Museum', array('action' => 'index', 'loc:'.$arr[0]));}
}

echo $loctxt;		
?>
</div>


</div><!-- /row (inner) -->
</div><!-- inner grid -->
<br />
<div class="data col-sm-8 col-sm-pull-4 col-xs-12">
<p style="font-size:.9em"><em><?=$this->Html->link('Order a museum-quality print of this object.',array('plugin'=>'','action'=>'order','?'=>array('accnum'=>urlencode($treasure['Treasure']['accnum']))))?></em></p>
<? 

	if(!empty($treasure['Treasure']['objtitle'])){
	echo '<p><span class="field-name">Object name: </span> '. $treasure['Treasure']['objtitle'].'</p>'; 
	$filled++;
	}
if(!empty($treasure['Treasure']['accnum'])){
echo '<p><span class="field-name">Accession Number:</span> '.$treasure['Treasure']['accnum'].'</p>';
$filled++;
}


if(!empty($treasure['Treasure']['daterange'])){echo '<p><span class="field-name">Date : </span> '.$treasure['Treasure']['daterange'].'</p>'; $filled++; }
if(!empty($treasure['Treasure']['gloss'])){echo '<p><span class="field-name">Gloss: </span>'.$treasure['Treasure']['gloss'].'</p>'; $filled++;}
if(!empty($treasure['Treasure']['dimensions'])){echo '<p><span class="field-name">Dimensions: </span>'.$treasure['Treasure']['dimensions'].'</p>'; $filled++;}
if(!empty($treasure['Treasure']['creditline'])){echo '<p><span class="field-name">Credit Line: </span>'.$treasure['Treasure']['creditline'].'</p>';$filled++;}


if(!empty($treasure['Treasure']['commonname'])){echo '<p><span class="field-name">Common Name: </span>'.$treasure['Treasure']['commonname'].'</p>';$filled++;}
if(!empty($treasure['Treasure']['taxonomic'])){echo '<p><span class="field-name">Taxonomic: </span>'.$treasure['Treasure']['taxonomic'].'</p>';$filled++;}
if(!empty($treasure['Treasure']['genus'])){echo '<p><span class="field-name">Genus species: </span><i>'.$treasure['Treasure']['genus'].'</i></p>';$filled++;}

if(!empty($treasure['Treasure']['remarks'])){echo '<p><span class="field-name">Remarks: </span>'.$treasure['Treasure']['remarks'].'</p>';$filled++;}

if(!empty($treasure['Treasure']['inscription'])){echo '<p><span class="field-name">Inscription: </span>'.$treasure['Treasure']['inscription'].'</p>';$filled++;}


if(!empty($treasure['Treasure']['synopsis'])){echo '<p><span class="field-name">Synopsis: </span>'.$treasure['Treasure']['synopsis'].'</p>';$filled++;}

?>
<?
//total the record and assign color
$completecolor=$color['red'];
$complete=round(($filled/$possible)*100);
if ($complete>=30) $completecolor=$color['yellow'];
if ($complete>=60) $completecolor=$color['orange'];
if ($complete>=80) $completecolor=$color['green'];
?>
<h3>Record Completeness</h3>
<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="<?=$complete?>" aria-valuemin="0" aria-valuemax="100" style="background-color:<?=$completecolor?> ;font-family: verdana, sans-serif; min-width: 2em; width: <?=$complete?>%;">
    <?=$complete?>%
  </div>
</div>
<p><strong>Know something we don't? Have a question?</strong> Just leave a comment at the bottom of this page and we'll get back to you.</p>

<?if (!empty($treasure['Tag'])):?>
<h3>Tags</h3>
<p>
<?
	$numItems = count($treasure['Tag']);
	$i = 0;

	foreach ($treasure['Tag'] as $tag):?>
	<div class="badge-hov">
	<?
		$badge=' <span class="badge">'.$tag['tag_count'].'</span>';
		echo $this->Html->link($tag['name'].$badge, array('controller' => 'treasures', 'action' => 'index', 'tags:'.$tag['name']),array('escape'=>false));
		if(++$i != $numItems)
			echo' - ';?>
	</div>
			<?
	endforeach;
	?>
</p>
<br />

<?endif?>
<?if (!isset($ajax)):?>
<div class="share-links">
	<div class="g-plusone" data-href="<?='http://'.$_SERVER['HTTP_HOST'].$this->here.'?utm_source=gplus&utm_campaign=onlinecollections'?>"></div>

    <div class="fb-share-button" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=facebook&utm_campaign=onlinecollections' ?>" data-type="button_count"></div>
	<div style="display:inline-block;">
    <a href="https://twitter.com/share" class="twitter-share-button" data-via="centerofthewest" data-hashtags="OnlineCollections" data-url="<?='http://'.$_SERVER['HTTP_HOST'].$this->here.'?utm_source=twitter&utm_campaign=onlinecollections'?>"></a>
	</div>
</div>
</div><!-- /data and tags and social icons -->
<?endif?>

</div><!-- /row -->
<br />
<div class="row">

<?
//we load these now via async AJAX, really cut page load time bc file_get_contents is so slow (also tried cURL)
if(!empty($treasure['Relation'])):?>
<div class="col-sm-8 related_articles">
<h3 style="margin:5px 0px 10px 0px;">Related Articles</h3>
	<?foreach ($treasure['Relation'] as $article):?>
<?	//$strJson = @file_get_contents('http://centerofthewest.org/wp-json/posts/'.$article['blogid'].'/'); ?>
	<script>
$(document).ready(function() { 
  	$.ajax({
	async:true,
	dataType:"jsonp",
	success:function (data, textStatus) {

		var html='<div class="row"><div class="col-xs-4">';
		html+='<a href="'+data['link']+'"><img src="'+data['featured_image']['attachment_meta']['sizes']['thumbnail']['url']+'" class="img-responsive img-thumbnail alt=" " /></a>';
		html+='</div><div class="col-xs-8"><p style="text-align:justify;">';
		html+='<a href="'+data['link']+'" >'+data['title']+'</a><br />';
		html+='<span style="font-style: italic; font-size:90%"> By '+data['author']['name']+"</span><br />";
		html+=data['excerpt'];
		html+='</p><hr /></div></div><br />';
		
		$('.related_articles').append(html);
	},
	url:"http://centerofthewest.org/wp-json/posts/<?=$article['blogid']?>/?_jsonp=?"});
	return false;
});
</script>
<?endforeach?>

</div>
<?endif?>
<?
if(!empty($treasure['Usergal'])):?>
<div class="col-sm-8">
<h3 style="margin:5px 0px 10px 0px;">Virtual Galleries</h3>
	<?foreach ($treasure['Usergal'] as $gal):
	$img_link='http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$gal['img'])).'/TileGroup0/0-0-0.jpg';
	?>
	<div class="row">
	<div class="col-xs-4">
	<?=$this->Html->link($this->Html->image($img_link,array('class'=>'img-responsive img-thumbnail','alt'=>$gal['name'])),array('controller' => 'usergals','action' => 'view', $gal['id']),array('escape'=>false))?>
	</div>
	<div class="col-xs-8">
	<?
	
		?>

			<?
			echo $this->Html->link($gal['name'],array('controller' => 'usergals','action' => 'view', $gal['id'])).'<span style="font-style: italic; font-size:90%"> - Curated by '.$gal['creator'].'</span>';
			echo '<br/>';?>
	
<?
		if(!empty($gal['TreasuresUsergal']['comments']))
		{
	
			echo $gal['TreasuresUsergal']['comments'].'<br />';		
		}
		?>
	</div>
	</div>
	<br />
	<?endforeach;?>
	
	
</div>
<?endif?>
<br />


</div><!-- /row -->
<?//here is the giant container, needs $user, $model, $fk, $comments?>
<?=$this->element('comments_container');?>
<?
//this was for the beginning of an AJAX login. It worked sort of but kept redirecting so I commented out
//echo ' <button id="login-button">Login</button>';

//sj break here for CommentPlugin 

//this what the plugin dumps to the view
//debug($commentsData);

//but the plugin itself has layouts in
//  Plugin/Comments/View/Elements for each structure (tree, flat, threaded)
// my tests have found 'tree' to be a good display, but the data is all stored the same
 ?>
</div><!-- /info-container -->
