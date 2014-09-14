<div class="breadcrumb">
<?php
/* ALL OLD BREADCRUMBS DISABLED
//the order is still TBD
//debug($this->params['url']);
//searchall
echo '<a href="/treasures/index/">Search</a>';
if (!empty($this->params['named']['searchall'])) echo ' > <a href="/treasures/index/searchall:'.$this->params['named']['searchall'].'">'.$this->params['named']['searchall'].'</a>';

//collection (listed alphabetically)
if (!empty($this->params['named']['bbm'])) echo ' > <a href="/treasures/index/bbm:'.$this->params['named']['bbm'].'">Buffalo Bill</a>';
if (!empty($this->params['named']['dmnh'])) echo ' > <a href="/treasures/index/dmnh:'.$this->params['named']['dmnh'].'">Yellowstone Nature</a>';
if (!empty($this->params['named']['cfm'])) echo ' > <a href="/treasures/index/cfm:'.$this->params['named']['cfm'].'">Firearms</a>';
if (!empty($this->params['named']['pim'])) echo ' > <a href="/treasures/index/pim:'.$this->params['named']['pim'].'">Plains Indians</a>';
if (!empty($this->params['named']['wg'])) echo ' > <a href="/treasures/index/wg:'.$this->params['named']['wg'].'">Western Art</a>';
*/

//NEW BREADCRUMBS
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
		
//pr($arr);		
	echo $this->Html->link($val,$arr). ' > ';
	
	}
$i++;
}

?>
</div>
<div class="search-help" id="srch">
<?php
$adv=$this->params['named'];
$adv['action']='advancedsearch';
echo $this->Html->link('Advanced Search',$adv).'<br />';
?>
<!-- a href="#">Advanced Search</a><br / -->

<a href="#" class="search-acc" id="tclass">Search by Accession Number</a>

</div>
<div class="treasure-search">
	<?php

		echo $this->Form->create('Treasure');
		echo '<div id="oid-search">'.$this->Chosen->select('Treasure.o',array(),array('data-placeholder' => 'Search by Object ID','onchange'=>'this.form.submit()')).'</div>';


	    echo $this->Form->input('searchall', array('div' => FALSE,'empty'=>true,'label'=>'','placeholder'=>'Search all Fields'));	 		
	    echo $this->Form->submit('/img/glass.png', array('div' => true));	
		echo '<div class="the-boxs" id="boxs">';
		if(empty($this->params['named'])){
			echo $this->Form->checkbox('bbm',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Buffalo Bill Museum    ';
			echo $this->Form->checkbox('cfm',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Cody Firearms Museum ';
			echo $this->Form->checkbox('dmnh',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Draper Natural History Museum<br>';
			echo $this->Form->checkbox('wg',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Whitney Western Art Museum';
			echo $this->Form->checkbox('pim',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Plains Indian Museum';
		}
		else{
			echo $this->Form->checkbox('bbm',array('div'=>false, 'class'=>'chkxbox')).'Buffalo Bill Museum    ';
			echo $this->Form->checkbox('cfm',array('div'=>false, 'class'=>'chkxbox')).'Cody Firearms Museum ';
			echo $this->Form->checkbox('dmnh',array('div'=>false, 'class'=>'chkxbox')).'Draper Natural History Museum<br>';
			echo $this->Form->checkbox('wg',array('div'=>false, 'class'=>'chkxbox')).'Whitney Western Art Museum';
			echo $this->Form->checkbox('pim',array('div'=>false, 'class'=>'chkxbox')).'Plains Indian Museum';
		}

		echo $this->Form->checkbox('d',array('div'=>false, 'class'=>'chkxbox')).'Show only items on display<br />';

?>

<div class="pagging">
	
<?php 
		echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
		echo $this->Form->input('pXv_9g', array('div' => false,'empty'=>true,'label'=>'Page ','default'=>$this->params['paging']['Treasure']['page']));	 

		echo $this->Paginator->counter(array('format' => __(' of {:pages} ')));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		echo'<div class="results">';
		echo $this->Form->input('n',array('div'=>false,'options'=>array(25=>25,50=>50,75=>75,100=>100),'default'=>$limit,'label'=>'Results per Page ','onchange'=>'this.form.submit()'));
		echo '</div>';
?>	
</div>       

<?		echo '</div>';		



		echo $this->Form->end();
		echo $this->Html->script('sj_autocp1');
		echo $this->Js->writeBuffer();
?>
</div>

<div>
<?php echo $this->Paginator->counter(array('format' => __('Showing objects {:start} to {:end} out of {:count}')));?>	
</div>
<div class="share-links-index">
    <div id="fb-root"></div>
    <div class="fb-like" data-href="https://www.facebook.com/centerofthewest" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>	

    <div class="fb-share-button" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=facebook&utm_campaign=onlinecollections' ?>" data-type="button_count"></div>

    <div class="g-plusone" data-href="<? echo 'http://collections.centerofthewest.org'.$this->here.'?utm_source=googleplus&utm_campaign=onlinecollections'?>"></div>

    <div style="display: inline-block;"><a href="https://twitter.com/share" class="twitter-share-button" data-via="centerofthewest" data-hashtags="OnlineCollections" data-url="<? echo $TWshorturl;?>">Tweet</a></div>

	</div><?

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
<input type="checkbox" checked name="sitesearch" value="collections.centerofthewest.org">search only Online CollectionsCenter of the West
</form>
</div>

';
}
//Featured Galleries

//$strJson = @file_get_contents('http://collections.centerofthewest.org/usergals/index.json?f');
//$arrJson = json_decode($strJson,true);
//seth updated to use regular variable and only appear on homepage
if ($usergals && $this->here=='/') 
{

	echo $this->Html->script('jquery.scrollbox.js');
	echo $this->Html->script('myScroll.js');
	echo '<div class="the-objects"><div class="img-block" style="text-align: center;vertical-align: middle;">Take a look at these Virtual Exhibits Create your own and it might be featured too!</div></div>';
	echo '<div id="featured-gals" class="scroll-img" style="width:616px;height: 156px;overflow: hidden;color:white;"><ul style="margin: 0;padding:0px;width: 1500px;">';
	foreach($usergals as $gal){
		echo '<li id="slidez" style="display: inline-block;margin: 0px;">';
		echo '<a href="http://collections.centerofthewest.org/Usergals/view/'.$gal['Usergal']['id'].'">';
		echo '<div class="the-objects">';
			if(!empty($gal['Usergal']['img']))echo '<div class="img-block" style="background-image: url(\'//collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$gal['Usergal']['img'])).'/TileGroup0/0-0-0.jpg\');"></div>';
			else echo '<div class="img-block" style="background-image: url(\'//collections.centerofthewest.org/img/non.jpg\');"></div>';
			if(!empty($gal['Usergal']['name']))echo '<div class="caption" style="position:relative;top: -50px;left: 0;background: url(http://collections.centerofthewest.org/img/trans-black.png);width: 100%;height: 50px;color:white;">'.$gal['Usergal']['name'].'</div>';
			if(!empty($gal['Usergal']['gloss']))echo '<div class="bubble" style="z-index:99999;display:none;position:absolute;width:300px;background-color: #ede9e7;color:#766a62;border: 1px solid #ddd;border-radius: 10px;">Curated by:'.$gal['Usergal']['creator'].'<br>'.$gal['Usergal']['gloss'].'</div>';
			else if(!empty($gal['Usergal']['creator']))echo '<div class="bubble" style="z-index:99999;display:none;position:absolute;width:300px;background-color: #ede9e7;color:#766a62;border: 1px solid #ddd;border-radius: 10px;">Curated By:'.$gal['Usergal']['creator'].'</div>';
		echo '</div></a></li>';
	}
	echo '</ul></div>';
	echo '<hr style="clear:both">';

}

//Featured Galleries
foreach ($treasures as $treasure):

//debug($treasure);
					
//					debug($val); ?>
<div class="the-objects">
	<?php				
//seth added anchor tags//lol i almost deleted them //haha that's why i left a comment
echo '<a name="t_'.$treasure['Treasure']['id'].'"></a>';
if(!empty($treasure['Treasure']['img']))
{
	echo'<div class="img-block" style="background-image: url(\'//collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img'])).'/TileGroup0/0-0-0.jpg\');">';
}
else
	echo'<div class="img-block" style="background-image: url(\'//collections.centerofthewest.org/img/non.jpg\');">';	


			echo '<div class="link">';			
				echo $this->Html->image('transparent.png',array('url'=>array('action' =>'view', $treasure['Treasure']['slug'])));
			echo'</div>';
			
			echo '<div class="caption">';
				echo '<div class="txt">';
				
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
				echo '<br>';
				//seth wrapped whole thing in bigger IF for Draper.
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
								//echo '</span>';
								
								
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

				
				echo'</div>';
				echo '<div class="gal">';				

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
				}
				echo '</div>';				
			echo '</div>';
echo '</div>'
		?>
</div>


<?php endforeach; ?>
<div style="margin-top:20px;">&nbsp;</div>
</div>

<div class="btm-pagging">
<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>

</div>

<div style="margin-top:20px;">&nbsp;</div>