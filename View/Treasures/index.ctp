<? //foreach ($treasures as $object){
	//	echo '<h3>'.$object['Treasure']['accnum'].'</h3>';
	//	}
?>
<a name="index-top"></a>
<script>
$(document).ready(function(){
//smooth scrolling, easy copy-paste! - makes modal not work if applied globally
$(function() {
  $('a[href*=#index-top]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
$('.send-coffee').hover(function(event) {
	console.log('hover');
	$(this).toggleClass('send-coffee-hover');
});

$('.notify-me').click(function(event) {
	
	$(this).fadeOut();
	$('.update-msg').slideUp(800).fadeOut();
	$('.notify-form').delay(1000).fadeIn().slideDown(1000);

});

$('.send-coffee').click(function(event) {

	$(this).addClass('send-coffee-click');
	$.ajax({
	async:true,
	data:$("#TreasureSendmsgForm").serialize(),
	//if you add this dataType as json then it will look for a view in Comments/json/
	dataType:"html",
	success:function (data, textStatus) {
		$(".msg-ajax-result").html(data);
	},
	type:"POST",
	url:"<?=Router::url(['controller' => 'treasures', 'action' => 'coffee'])?>"
	});

});


$( "#TreasureSendmsgForm" ).submit(function( event ) {
	//console.log($(this).val());
	$.ajax({
	async:true,
	data:$("#TreasureSendmsgForm").serialize(),
	//if you add this dataType as json then it will look for a view in Comments/json/
	dataType:"html",
	success:function (data, textStatus) {
		$(".msg-ajax-result").html(data);
	},
	type:"POST",
	url:"<?=Router::url(['controller' => 'treasures', 'action' => 'sendmsg'])?>"
	});
	event.preventDefault();
	//do I need the return false?
	return false;
});

});
</script>
<style>

.send-coffee-nohover{
	background: url('<?=$this->webroot?>img/coffee_grey.png') no-repeat;
}
.send-coffee-hover{
	background: url('<?=$this->webroot?>img/coffee.png') no-repeat !important;
}
.send-coffee-click{
	background: url('<?=$this->webroot?>img/coffee.png') no-repeat !important;
}
</style>
<?if (empty($this->params['named'])):?>
<div class="coffee-preload hidden"><?=$this->Html->image('coffee.png')?></div>
<div class="row new-message" style="    border: 1px dashed brown; padding: 21px; margin: 16px;">
<div class="col-xs-12 col-sm-6" style="margin-top:40px">
<?=$this->Html->image('centennial.jpg',['class'=>'img-responsive'])?>
</div>
<div class="col-xs-12 col-sm-6">
<p class="update-msg"><span style="font-size:1.5em; font-weight:bold;" >Great news! </span>We are launching an updated version of this site soon.<br /> The update will include more treasures, easier navigation, better search, enhanced interactive features, and more!<br /><strong>If you would like to be notified when the site launches or provide feedback please do.</strong><br /> If you would like to send an anonymous, Virual Cup of Coffee to our programmer simply click the coffee cup.</p>
<div class="msg-ajax-result"></div>
<div class="notify-form" style="display: none;">

<?
echo $this->Form->create('Treasure',['action'=>'sendmsg','controller'=>'treasures']);
echo $this->Form->input('email',['required'=>'required','class'=>'form-control','placeholder'=>'E-mail address']); 
echo $this->Form->input('message',['type'=>'textarea','class'=>'form-control','placeholder'=>'Suggestions, comments, feedback, or encouragement welcome (optional)']); ?>
<br />
<?
echo $this->Form->input('beta', ['label'=>false,'type'=>'select','options'=>[0=>'Notify me when it\'s launched',1=>'I\'m willing to test the pre-release']]);
echo '<br />';
echo $this->Form->submit('Send',['class'=>'btn btn-lg btn-success send-button']);
echo $this->Form->end();
?>

</div>
<div class="row">
<div class="col-xs-12 col-sm-6">
<span class="btn btn-lg btn-success notify-me submit-msg" style="margin-top: 15px">Notify Me</span>
</div>
<div class="col-xs-12 col-sm-6">
<div class="send-coffee send-coffee-nohover" style="height:71px; width: 71px; cursor:pointer;">
<span class="coffee-breaks badge-orange badge" style="display:inline; position: absolute; top:55px;right:97px; font-family:verdana; font-size:.7em; background-color:<?=$color['green']?>"><?=$coffees?></span>
</div>
<p style="font-size: .7em">1.67.228, pewter mug</p>
<? //=$this->Html->image('coffee_grey.png',['class'=>'send-coffee','style'=>'cursor: pointer'])?>
</div>
</div>
</div>
</div><!-- /new version annouce row -->
<?endif //only show when no named params?>
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
echo $this->Form->input('searchall', array('div' => FALSE,'empty'=>true,'label'=>'','placeholder'=>'Search the Collection','class'=>'searchbox form-control'));	 
//this is hidden with CSS right now
$searchclass='search-btn';
if (isset($_SERVER['HTTP_USER_AGENT']) &&
    ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) || strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false)) {   
     $searchclass='form-control';
    }
echo $this->Form->submit('Search', array('div' => false,'class'=>$searchclass));

?>
</div>
<div class="col-sm-3 col-xs-12" style="padding-top: 10px">
<div class="row">
<div class="hidden-xs">
<div class="col-sm-12 hidden-xs" style="padding-bottom:27px">
<div id="fb-root"></div>
<div class="fb-like"  data-href="https://www.facebook.com/centerofthewest" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>	
</div>
</div>
<div class="col-sm-12 col-xs-6">
<?
$adv=$this->params['named'];
$adv['action']='advancedsearch';
echo $this->Html->link('Advanced Search',$adv,array('class'=>'')).'<br />';?>
</div>
<div class="col-sm-12 col-xs-6">
<?
echo $this->Html->link('Site Search',array('action'=>'google_search_page','controller'=>'treasures'),array('class'=>'site-search')).'<br />';
?>
</div>
</div>
</div>
</div>
<br />
<div class="row checkbox-label">
<?
$boxoptions=array('div'=>false,'class'=>'regular-checkbox');
if(empty($this->params['named']['bbm'])&&empty($this->params['named']['dmnh'])&&empty($this->params['named']['pim'])&&empty($this->params['named']['wg'])&&empty($this->params['named']['cfm'])) $boxoptions['checked']=1;
?>
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
<?
//featured Galleries, seth disabled with 1=2
if ($usergals && empty($this->request->params['named']) && 1==2) :?>
<br />
<div class="featured-vgals hidden-xs hidden-sm">
<div class="panel panel-default">
<div class="panel-heading"><h1 class="panel-title"><strike>Featured Virtual Exhibits</strike> <?=$this->html->link('Contest Entries!',array('action'=>'contest'))?></h1></div>
<div class="panel-body">
<?
	echo $this->Html->script('jquery.scrollbox.js');
	echo $this->Html->script('myScroll.js');?>
	<div id="featured-gals" class="scroll-img" style="height: 156px;overflow: hidden;color:white;">
	<ul style="margin: 0;padding:0px;width:1500px;">
	<?
	foreach($usergals as $gal):?>
		<li class="slides" style="display: inline-block;margin: 0px; font-size:1em;">
		<a href="http://collections.centerofthewest.org/usergals/view/<?=$gal['Usergal']['id']?>">
		<div class="the-objects">
			
			<div class="img-block" style="background-image: url('//collections.centerofthewest.org/zoomify/1/<?=str_replace(' ','_',str_replace('#','',$gal['Usergal']['img']))?>/TileGroup0/0-0-0.jpg');"></div>
			<?
			if(!empty($gal['Usergal']['name']))echo '<div class="caption" style="position:relative;top: -50px;left: 0;background: url(http://collections.centerofthewest.org/img/trans-black.png);width: 100%;height: 50px;color:white;">'.$gal['Usergal']['name'].'</div>';
			?>
			<div class="bubble">
			<?
			if(!empty($gal['Usergal']['gloss']))echo '"'.$this->Text->truncate($gal['Usergal']['gloss'],200,array('exact'=>true)).'"<hr />';
			?>
			<span class="allcaps" style="font-weight:bold">
			<?
			echo 'Curated by '.$gal['Usergal']['creator'];
			?>
			</span>
			</div>
			
		</div></a></li>
	<?endforeach?>
	</ul></div>
</div>
<div class="panel-footer"><?=$this->Html->link('Create your own',array('controller'=>'treasures','action'=>'pack'))?> and it might be featured too!</div>
</div><!-- /panel -->

	<hr style="clear:both">
</div><!-- /featured vgals -->

<?endif?>
<a name="search-results"></a>
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

<?=$this->element('paging')?>

<?endif?>
<div class="col-md-12">
<div class="row">
<div class="col-sm-6">
<p>
<? 
$cnt =$this->Number->format($this->Paginator->counter(array('format' => __('{:count}'))));
echo $this->Paginator->counter(array('format' => __('Viewing records {:start} to {:end} out of '.$cnt)));
?>
<?
if (!empty($this->params['named']['searchall'])) echo ' for <strong>'.$this->params['named']['searchall'].'</strong> ';
?>
</p>
</div>
<div class="col-sm-6">
<?=$this->Html->link('<span class="glyphicon glyphicon-collapse-up"></span> Refine Search','#index-top',array('escape'=>false))?>
</div>
</div>
<? if(empty($treasures)):?>
<br />
<br />
<br />
<div class="row">
<div class="col-xs-12">
<h4>No results found. Try using <?=$this->Html->link('Advanced Search',$adv,array())?>, or the box below for Google Site Search.</h4>
<?=$this->element('google_search')?>
</div>
</div>

<? else: ?>
<div class="row">
<?
foreach ($treasures as $treasure):
?>
<div class="the-objects col-xs-4">
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


<?endforeach?>
</div>
<?endif?>
<div style="margin-top:20px;">&nbsp;</div>
</div><!-- /search-results -->
<br style="clear:both;" />
<?=$this->element('paging')?>
<div style="margin-top:20px;">&nbsp;</div>