
<div class="row">
<div class="col-md-12">
<?
		if(!empty($usergal['Usergal']['name']))
			echo '<h2>'.$usergal['Usergal']['name'].'</h2>';
		if(!empty($usergal['Usergal']['gloss']))
			echo '<em>'.$usergal['Usergal']['gloss'].'</em>';

		if(!empty($usergal['Usergal']['creator']))
			echo '<br /><span class="allcaps">Curated by '.$usergal['Usergal']['creator'].'</span>';
			?>

<!-- div class="share-links">
    <div id="fb-root"></div>
    <div class="fb-like" data-href="https://www.facebook.com/centerofthewest" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
    <div class="fb-share-button" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=facebook&utm_campaign=onlinecollections' ?>" data-type="button_count"></div>

    <div class="g-plusone" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=googleplus&utm_campaign=onlinecollections'?>"></div>
    <div style="display: inline-block;"><a href="https://twitter.com/share" class="twitter-share-button" data-via="centerofthewest" data-hashtags="OnlineCollections" data-url="<? echo $TWshorturl;?>">Tweet</a></div>
	<script type="text/javascript" src="//www.reddit.com/static/button/button1.js"></script>
</div -->
<?=$this->element('paging')?>   
 </div>
</div><!-- /row -->
<hr />
<script>
$(document).ready(function(){
//set defaults
cbw="100%";
cbh="75%";
//override if screen wider than tall
if ($( window ).width()>=$( window ).height()){
	cbw="80%";
	cbh="100%";
}
	$(".ajax").colorbox({rel:'ajax',width:cbw,height:cbh,opacity:0.75,current:"Viewing object {current} of {total}"});
});
</script>
<style>
.img-responsive{
	//max-width:75%;
	margin: 0 auto;
}
</style>
<?
	echo 'This gallery has '.$this->Number->format($this->Paginator->counter(array('format' => __('{:count}')))).' objects<br />';
foreach ($treasures as $treasure): ?>
<div class="row">
<div class="the-objects col-sm-3 col-xs-6">
<?if(!empty($treasure['Treasure']['img']))
$css_img='zoomify/1/'.str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img'])).'/TileGroup0/0-0-0.jpg';
else $css_img='img/non.jpg';
?>
<div class="img-block" style="background-image: url('//collections.centerofthewest.org/<?=$css_img?>');">
<div class="link">
<?=$this->Html->link($this->Html->image('transparent.png'),array('controller'=>'treasures','action' =>'view', $treasure['Treasure']['slug']),array('escape'=>false,'class'=>'ajax cboxElement'))?>
<? //=$this->Html->link($this->Html->image('transparent.png'),'#mode',array('escape'=>false,'data-toggle'=>'modal', 'data-target'=>'.bs-example-modal-lg'))?>
<? //=$this->Html->image('transparent.png',array('url'=>array('controller'=>'treasures','action' =>'view', $treasure['Treasure']['slug'])))?>
</div>
			
	<div class="caption vgal">
	<span class="glyphicon glyphicon-search icon"></span>			
	</div>
</div><!-- /imgblock -->
<!--div class="comments"><?=$treasure['TreasuresUsergal']['comments']?></div -->
</div><!-- /the objects -->
<div class="col-sm-1 hidden-xs"></div>
<div class="col-sm-8 col-xs-6 vgal-info">
<br />
<?
if (!empty($treasure['TreasuresUsergal']['comments'])) '<em>'.$comment=$treasure['TreasuresUsergal']['comments'].'</em>';
else $comment=$this->Text->truncate($treasure['Treasure']['synopsis'],160,array('exact'=>true));
?>
<p>
<?=$comment?>
<br />
<?=$this->Html->link('Visit record &raquo;',array('controller'=>'treasures','action' =>'view', $treasure['Treasure']['slug']),array('escape'=>false))?>
</p>
</div>
</div><!-- /row -->

<?php endforeach; ?>

<div class="flag">
<?
		//echo $this->Form->postLink('Flag as Inappropriate', array('action' => 'dousergal','x:'.$usergal['Usergal']['id']));
		echo $this->Form->postLink('Flag as Inappropriate', array(), null, __('Are you sure you want to flag this?'));
		echo'<br>';
		echo $this->Html->link('Load an Exhibit', array('controller'=>'usergals','action' => 'load'));
		echo'<br>';
		echo $this->Html->link('Add to your Exhibit', array('controller'=>'treasures','action' => 'index'));		
?>
</div>
<?=$this->element('paging')?>
<div id="post-comments">
    <?php $this->CommentWidget->options(array('allowAnonymousComment' => false));?>
    <?php echo $this->CommentWidget->display();?>
</div>

<div id="mode" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>