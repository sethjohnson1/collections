<div class="treasure-search allcaps">
<div class="row">
<div class="col-sm-9 col-xs-12">
<div class="breadcrumb">
<?php

//NEW BREADCRUMBS - not sure if they work right, need to check later
$i=0;
foreach ($breadcrumb as $key=>$val){
$arr=$this->params['named'];
$arr['action']='index';
if ($i==count($breadcrumb)-1) 
	echo $val.' > ';
else
	{
	//cascade through..
	if ($key<5) {
		unset($arr['accnum']);
		unset($arr['daterange']);
		unset($arr['dimensions']);
		unset($arr['objtitle']);
		unset($arr['creditline']);
		unset($arr['gloss']);
		unset($arr['inscription']);
		unset($arr['remarks']);
		unset($arr['commonname']);
		unset($arr['genus']);
		unset($arr['synopsis']);
	}
	
	if ($key<4) unset($arr['searchall']);
			
	if ($key<3) unset($arr['medvalues']);
	if ($key<3) unset($arr['tags']);
			
	if ($key<2) unset($arr['makers']);
			
	if ($key<1)
	{
		unset($arr['loc']);
		unset($arr['d']);
		}
			
	echo $this->Html->link($val,$arr). ' > ';
	
	}
$i++;
}

?>
</div>


<?
echo $this->Form->create('Treasure',array('class'=>''));
echo $this->Form->input('searchall', array('div' => FALSE,'empty'=>true,'label'=>'','placeholder'=>'Search the Collection','class'=>'searchbox indexsearch form-control'));	 
echo $this->Form->submit('/img/glass.png', array('div' => false,'class'=>'search-btn','style'=>'visibility:hidden; position: absolute; top: -9999px; left:-9999px;'));
?>
</div>

<div class="col-sm-3 hidden-xs">
<div class="fb-like hidden-xs" data-href="https://www.facebook.com/centerofthewest" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>	
<?
$adv=$this->params['named'];
$adv['action']='advancedsearch';
echo $this->Html->link('Advanced Search',$adv,array('class'=>'search-help')).'<br />';

$boxoptions=array('div'=>false,'class'=>'regular-checkbox');

if(empty($this->params['named']['bbm'])) $boxoptions['checked']=1;

?>
</div>
</div>
<br />
<div class="row checkbox-label">
<div class="col-sm-4 col-xs-6">
<?
echo $this->Form->checkbox('bbm',$boxoptions).' Buffalo Bill';
?>
</div>
<div class="col-sm-4 col-xs-6">
<?
echo $this->Form->checkbox('wg',$boxoptions).' Western Art';?>
</div>
<div class="col-sm-4 col-xs-6">
<?
echo $this->Form->checkbox('cfm',$boxoptions).' Firearms';
?>
</div>

<div class="col-sm-4 col-xs-6">
<?
echo $this->Form->checkbox('pim',$boxoptions).' Plains Indian';
?>
</div>
<div class="col-sm-4 col-xs-12">
<?
echo $this->Form->checkbox('dmnh',$boxoptions).' Natural History';
?>
</div>
<div class="col-sm-4 col-xs-12">
<?
echo $this->Form->checkbox('d',array('div'=>false,'class'=>'regular-checkbox')).' on display';
?>
</div>
     
</div>		
		

<?
		
		echo $this->Js->writeBuffer();
?>
</div><!-- /treasure-search -->

<? /*
<div class="share-links-index">
    <div id="fb-root"></div>
    <div class="fb-like" data-href="https://www.facebook.com/centerofthewest" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>	

    <div class="fb-share-button" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=facebook&utm_campaign=onlinecollections' ?>" data-type="button_count"></div>

    <div class="g-plusone" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=googleplus&utm_campaign=onlinecollections'?>"></div>

    <!--div style="display: inline-block;">
	<a href="https://twitter.com/share" class="twitter-share-button" data-via="centerofthewest" data-hashtags="OnlineCollections" data-url="<? echo $TWshorturl;?>">Tweet</a>
	<script type="text/javascript" src="//www.reddit.com/static/button/button1.js"></script>
	</div -->
	

</div> */
?>
<?

if(empty($this->params['named']['bbm']))
{
	if(empty($this->params['named']['wg']))
	{
		if(empty($this->params['named']['pim']))	
		{
			if(empty($this->params['named']['cfm']))
			{
				if(!empty($this->params['named']['dmnh'])=='1')
				{
					//draper only code here
					echo '<div class="draper-only">';
					echo 'Sort by: '. $this->Paginator->sort('genus').' | ';
					echo $this->Paginator->sort('commonname');
					echo '</div>';
				}
			}
		}
	}
}
?>
<div class="draperdiv">

</div>

<div class="search-results" style="clear:both">
<?php 
if(empty($treasures)){
echo 'No results found. Try Google Custom search instead!
<div style="background-color:border: 1px solid #ddd;width:1002px;">
<form method="get" action="http://www.google.com/search"> 
<input type="text" name="q" size="70" maxlength="255" value="" placeholder="Google Search"> 
<input type="submit" value="Search"><br>
<input type="checkbox" checked name="sitesearch" value="collections.centerofthewest.org">search only Online Collections Center of the West
</form>
</div>

';
}
//featured Galleries
if ($usergals && empty($this->request->params['named'])) :?>
<div class="featured-vgals">
<div class="well">
<?
	echo $this->Html->script('jquery.scrollbox.js');
	echo $this->Html->script('myScroll.js');?>
	<div class="the-objects vgalbox"><div class="img-block" style="text-align: center;vertical-align: middle;">
	Take a look at these Virtual Exhibits Create your own and it might be featured too!</div></div>
	<div id="featured-gals" class="scroll-img" style="height: 156px;overflow: hidden;color:white;">
	<ul style="margin: 0;padding:0px;width: 1500px;">
	<?
	foreach($usergals as $gal):?>
		<li id="slidez" style="display: inline-block;margin: 0px; font-size:1em;">
		<a href="http://collections.centerofthewest.org/usergals/view/<?=$gal['Usergal']['id']?>">
		<div class="the-objects">
			
			<div class="img-block" style="background-image: url('//collections.centerofthewest.org/zoomify/1/<?=str_replace(' ','_',str_replace('#','',$gal['Usergal']['img']))?>/TileGroup0/0-0-0.jpg');"></div>
			<?
			if(!empty($gal['Usergal']['name']))echo '<div class="caption" style="position:relative;top: -50px;left: 0;background: url(http://collections.centerofthewest.org/img/trans-black.png);width: 100%;height: 50px;color:white;">'.$gal['Usergal']['name'].'</div>';
			if(!empty($gal['Usergal']['gloss']))echo '<div class="bubble" style="z-index:99999;display:none;position:absolute;width:300px;background-color: #ede9e7;color:#766a62;border: 1px solid #ddd;border-radius: 10px;">Curated by:'.$gal['Usergal']['creator'].'<br>'.$gal['Usergal']['gloss'].'</div>';
			else if(!empty($gal['Usergal']['creator']))echo '<div class="bubble" style="z-index:99999;display:none;position:absolute;width:300px;background-color: #ede9e7;color:#766a62;border: 1px solid #ddd;border-radius: 10px;">Curated By:'.$gal['Usergal']['creator'].'</div>';?>
		</div></a></li>
	<?endforeach?>
	</ul></div>
</div><!-- /well -->

	<hr style="clear:both">
</div><!-- /featured vgals -->
<?endif?>
<?
//only show paging if more than one page
$controller = $this->name;
$model = trim($controller , "s");
if ($this->request->paging[$model]['pageCount']>1):
?>
<hr />
<div class="row allcaps">
<div class="form-group col-sm-4">
    <div class="input-group">
      <div class="input-group-addon orange-bg">Jump to</div>
	  <?=$this->Form->input('pXv_9g', array('div' => false,'name'=>'goto','onchange'=>'document.getElementById("TreasurePXv9g").setAttribute("name","data[Treasure][pXv_9gg]");','empty'=>true,'placeholder'=>'Page ','label'=>'','class'=>'pagenum form-control','type'=>'number','min'=>1,'max'=>$this->Paginator->counter(array('format' => __('{:pages}')))
//,'default'=>$this->params['paging']['Treasure']['page']
));	 ?>
      <div class="input-group-addon orange-bg">of<?= $this->Paginator->counter(array('format' => __(' {:pages}')))?></div>
    </div>
</div>

<div class="form-group col-sm-4">
    <div class="input-group">
      <div class="input-group-addon orange-bg">Show</div>
	  <?=$this->Form->input('n',array('div'=>false,'options'=>array(25=>25,50=>50,75=>75,100=>100),'default'=>$limit,'label'=>'','onchange'=>'this.form.submit()','class'=>'form-control'))?>
      <div class="input-group-addon orange-bg">per page</div>
    </div>
</div>
</div>
<!-- this should be an element -->
<div class="row allcaps">
<div class="col-md-12">
<ul class="pagination">
<?

//this is the way to do it with Bootstrap, probably will make this an element 
		echo $this->Paginator->prev('<<', array('tag'=>'li'), null, array('class' => 'prev disabled','escape'=>'false','tag'=>'li','disabledTag'=>'a'));
		//notice class names, there is a special one for "xs" view
		echo $this->Paginator->numbers(array('currentTag'=>'a','currentClass'=>'active','separator' => '','tag'=>'li','before'=>'','after'=>'','modulus'=>13,'class'=>'hidden-xs'));
		echo $this->Paginator->numbers(array('currentTag'=>'a','currentClass'=>'active','separator' => '','tag'=>'li','before'=>'','after'=>'','modulus'=>6,'class'=>'visible-xs-inline'));
		echo $this->Paginator->next('>>', array('tag'=>'li'), null, array('class' => 'next disabled'));
?>
</ul>
</div>
</div>
<?endif?>
<div class="col-md-12">
<? 
$cnt =$this->Number->format($this->Paginator->counter(array('format' => __('{:count}'))));
echo $this->Paginator->counter(array('format' => __('Viewing records {:start} to {:end} out of '.$cnt)));
?>

</div>
<?
foreach ($treasures as $treasure):
?>
<div class="the-objects col-md-2">
	<?php				
//seth added anchor tags//lol i almost deleted them //haha that's why i left a comment
echo '<a name="t_'.$treasure['Treasure']['id'].'"></a>';
if(!empty($treasure['Treasure']['img']))
$css_img='zoomify/1/'.str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img'])).'/TileGroup0/0-0-0.jpg';
else $css_img='img/non.jpg';
?>
<div class="img-block" style="background-image: url('//collections.centerofthewest.org/<?=$css_img?>');">
	<div class="link">
	<?=$this->Html->image('transparent.png',array('url'=>array('action' =>'view', $treasure['Treasure']['slug'])))?>
	</div>
	<div class="caption visible-xs-*">
		<div class="txt">
				<?
			//seth wrapped in bigger IF for Draper
			 if ($treasure['Treasure']['collection']!='DMNH'){
				if(!empty($treasure['Treasure']['objtitle']))
				{
					if(strlen($treasure['Treasure']['objtitle'])>=16)
						echo $this->Html->link(substr($treasure['Treasure']['objtitle'],0,15).'...', array('action' => 'view', $treasure['Treasure']['slug']));
					else
						echo $this->Html->link($treasure['Treasure']['objtitle'], array('action' => 'view', $treasure['Treasure']['slug']));
					
				}
				else echo $this->Html->link($treasure['Treasure']['accnum'], array('action' => 'view', $treasure['Treasure']['slug']));
				}
			else {
				if(!empty($treasure['Treasure']['commonname']))
				{
					if(strlen($treasure['Treasure']['commonname'])>=16)
						echo $this->Html->link(substr($treasure['Treasure']['commonname'],0,15).'...', array('action' => 'view', $treasure['Treasure']['slug']));
					else
						echo $this->Html->link($treasure['Treasure']['commonname'], array('action' => 'view', $treasure['Treasure']['slug']));
				}
				else echo $this->Html->link($treasure['Treasure']['accnum'], array('action' => 'view', $treasure['Treasure']['slug']));
			}
				
				$i=0;
				$caption='';
				echo '<br />';
				//seth wrapped whole thing in bigger IF for Draper.
				//sj - not sure why this was so complicated...
				if (!empty($treasure['Maker'])){
						foreach ($treasure['Maker'] as $val)
						{
							if(!empty($val['name']))
							{
								if($i >= 3)
									break;
								else
								{
									if(strlen($val['name'])>=26)//this checks if what its about to output if its to big then just write it down use the max length and then quit the loop and echo
									{									
										$caption .= $val['name'];
										break;										
									}
									else
									{
										$caption .= $val['name'];
										if($i < 3)//checks if its not this is the last loop only reason to add a pipe
											$caption .= '|';
									}
								}
								$i++;
							}	
						}
					if(strlen($caption)>=21)
					{												
						echo '<span class="med">'.substr($caption,0,20).'...</span>';						
					}
					else
					{
						if(substr($caption,-1)=="|")
							echo '<span class="med">'.rtrim($caption,'|').'</span>';
						else if(substr($caption,-1)==",")
							echo '<span class="med">'.rtrim($caption,',').'</span>';

						else
							echo '<span class="med">'.$caption.'</span>';
					}
				}
				else {
					if(!empty($treasure['Treasure']['genus'])) {
						echo '<span class="med">';
						echo $treasure['Treasure']['genus'];
						echo '</span>';
					}
				}
?>
				
				</div>
				<div class="gal">			
<?
				if(in_array($treasure['Treasure']['id'],$Vgals))
				{
					// already in pack
					echo '<a id="add" class="invisible" onclick="setCookie(\''.$treasure['Treasure']['id'].'\');">'.$this->Html->image('add.png',array('id'=>'add')).'</a>';
					echo '<a class="xs" id="remove" onclick="deleteCookie(\''.$treasure['Treasure']['id'].'\');">'.$this->Html->image('remove.png',array('id'=>'remove')).'</a>';
				}
				else
				{
					//not in pack yet
					echo '<a id="add" class="xs" onclick="setCookie(\''.$treasure['Treasure']['id'].'\');">'.$this->Html->image('add.png',array('id'=>'add')).'</a>';
					echo '<a class="invisible" id="remove" onclick="deleteCookie(\''.$treasure['Treasure']['id'].'\');">'.$this->Html->image('remove.png',array('id'=>'remove')).'</a>';				
				}?>
				</div>			
				
			</div><!-- /caption -->
</div><!-- /img-block -->
		
</div><!-- /the-objects -->


<?php endforeach; ?>
<div style="margin-top:20px;">&nbsp;</div>
</div><!-- /search-results -->
<br style="clear:both;" />
<?if ($this->request->paging[$model]['pageCount']>1):?>
<div class="row allcaps">
<div class="col-md-12">
<ul class="pagination">
<?

//this is the way to do it with Bootstrap, probably will make this an element 
		echo $this->Paginator->prev('<<', array('tag'=>'li'), null, array('class' => 'prev disabled','escape'=>'false','tag'=>'li','disabledTag'=>'a'));
		//notice class names, there is a special one for "xs" view
		echo $this->Paginator->numbers(array('currentTag'=>'a','currentClass'=>'active','separator' => '','tag'=>'li','before'=>'','after'=>'','modulus'=>13,'class'=>'hidden-xs'));
		echo $this->Paginator->numbers(array('currentTag'=>'a','currentClass'=>'active','separator' => '','tag'=>'li','before'=>'','after'=>'','modulus'=>6,'class'=>'visible-xs-inline'));
		echo $this->Paginator->next('>>', array('tag'=>'li'), null, array('class' => 'next disabled'));
?>
</ul>
</div>
</div>
<?endif?>
<div style="margin-top:20px;">&nbsp;</div>