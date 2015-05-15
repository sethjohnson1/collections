<div class="row">
<div class="col-md-12">
<?
		if(!empty($usergal['Usergal']['name']))
			echo '<h2>'.$usergal['Usergal']['name'].'</h2>';
		if(!empty($usergal['Usergal']['creator']))
			echo '<strong>Curated by:</strong> '.$usergal['Usergal']['creator'];
		if(!empty($usergal['Usergal']['gloss']))
			echo '<br><em>'.$usergal['Usergal']['gloss'].'</em>';?>

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

<?php foreach ($treasures as $treasure): ?>
<div class="row">
<div class="the-objects col-sm-3">
<?if(!empty($treasure['Treasure']['img']))
$css_img='zoomify/1/'.str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img'])).'/TileGroup0/0-0-0.jpg';
else $css_img='img/non.jpg';
?>
<div class="img-block" style="background-image: url('//collections.centerofthewest.org/<?=$css_img?>');">
<div class="link"><?=$this->Html->image('transparent.png',array('url'=>array('controller'=>'treasures','action' =>'view', $treasure['Treasure']['slug'])))?>
</div>
			
	<div class="caption">
		<div class="txt">
			<?if(!empty($treasure['Treasure']['objtitle']))echo $this->Html->link(substr($treasure['Treasure']['objtitle'],0,20).'...', array('controller'=>'treasures','action' => 'view', $treasure['Treasure']['slug']));
			else echo $this->Html->link($treasure['Treasure']['accnum'], array('controller'=>'treasures','action' => 'view', $treasure['Treasure']['slug']));
		?>
		</div>
		
		<div class="gal">				
		<?if(in_array($treasure['Treasure']['id'],$Vgals))
		{
			
				//already in pack
				echo '<a id="add" class="invisible" onclick="setCookie(\''.$treasure['Treasure']['id'].'\');">'.$this->Html->image('add.png',array('id'=>'add')).'</a>';
				echo '<a class="xs" id="remove" onclick="deleteCookie(\''.$treasure['Treasure']['id'].'\');">'.$this->Html->image('remove.png',array('id'=>'remove')).'</a>';

		}
		else
		{
			//not in pack yet
			echo '<a id="add" class="xs" onclick="setCookie(\''.$treasure['Treasure']['id'].'\');">'.$this->Html->image('add.png',array('id'=>'add')).'</a>';
			echo '<a class="invisible" id="remove" onclick="deleteCookie(\''.$treasure['Treasure']['id'].'\');">'.$this->Html->image('remove.png',array('id'=>'remove')).'</a>';				
		}
		?>
		</div>				
	</div>
</div><!-- /imgblock -->
<!--div class="comments"><?=$treasure['TreasuresUsergal']['comments']?></div -->
</div><!-- /the objects -->
<div class="col-sm-1"></div>
<div class="col-sm-8 vgal-info">
<?
if (!empty($treasure['TreasuresUsergal']['comments'])) '<em>'.$comment=$treasure['TreasuresUsergal']['comments'].'</em>';
else $comment=$this->Text->truncate($treasure['Treasure']['synopsis'],160,array('exact'=>true));
?>
<p>
<?=$comment?>
<br />
<?=$this->Html->link('Visit record &raquo;',array(),array('escape'=>false))?>
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