<?=$this->element('contest_banner')?>
<?
if (isset($contest)) $ctext=' -  '.$this->Html->link('Contest Entries',array('action'=>'contest','controller'=>'treasures'));
else $ctext='';
?>
<h2>Virtual Exhibits<?=$ctext?></h2>

<h3>Check out a few virtual exhibits created from our online collections.
<br />
<?=$this->Html->link('Click here',array('?'=>array('contest'=>1)))?> to see only contest entries.
</h3>
<p>You can make your own: <?=$this->Html->link('click here to get started',array('action'=>'pack','controller'=>'treasures'),array('class'=>'myx')).'!'?></p>
<div class="row">    
<div class="col-md-12">
		<?
		echo $this->Form->create('Usergal', array('url' => array_merge(array('action' => 'index'), $this->params['pass'])));

	    echo $this->Form->input('searchall', array('div' => false,'empty'=>true,'label'=>'','placeholder'=>'Search the Exhibits','class'=>'searchbox form-control'));
		echo $this->Form->submit('/img/glass.png', array('div' => false,'class'=>'search-btn'));
		echo $this->Form->end();
		?>	
</div>
</div>
<br />
<div class="allcaps">
	<h4>Sort By</h4>		
	<p><?=$this->Paginator->sort('name').' | '.
	$this->Paginator->sort('creator').' | '.
	$this->Paginator->sort('created').' | '. 
	$this->Paginator->sort('modified')?></p>                
</div>

<?=$this->element('paging')?>
<?$cnt =$this->Number->format($this->Paginator->counter(array('format' => __('{:count}'))));
echo $this->Paginator->counter(array('format' => __('Viewing records {:start} to {:end} out of '.$cnt)));?>
<?php foreach ($usergals as $usergal): ?>
<div class="row">
<div class="col-sm-3 col-xs-6">
<div class="the-objects" style="">
	<div class="img-block" style="background-image: url('http://collections.centerofthewest.org/zoomify/1/<?=str_replace(' ','_',$usergal['Usergal']['img'])?>/TileGroup0/0-0-0.jpg')">

			<div class="link">			
				<?=$this->Html->image('transparent.png',array('url'=>array('action' =>'view', $usergal['Usergal']['id'])))?>
			</div>
			
	</div><!-- /imgblock -->
</div><!-- /theobjects -->
</div>
<div class="col-sm-9 col-xs-6">
<br />
<p class="vgal-info"><em><?=$usergal['Usergal']['name']?></em>
<br />
Curated by <?=$usergal['Usergal']['creator']?>
<br />
<?
$obj='objects';
if ($usergal['Usergal']['count']==1) $obj='object';
echo $usergal['Usergal']['count'].' '.$obj?><br />
<?=$this->html->link('Visit this exhibit &raquo;',array('controller'=>'usergals','action'=>'view',$usergal['Usergal']['id']),array('escape'=>false))?>
</p>

<?//debug($usergal)?>
</div>
</div><!-- /row -->
<br />
<?endforeach ?>


<?=$this->element('paging')?>

