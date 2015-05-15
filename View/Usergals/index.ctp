<h2>Virtual Exhibits</h2>

<h3>Check out a few virtual exhibits created from our online collections.</h3>
<p>You can make your own: <?=$this->Html->link('click here to get started',array('action'=>'pack','controller'=>'treasures')).'!'?></p>
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

<?php foreach ($usergals as $usergal): ?>
<div class="row">
<div class="col-sm-3">
<div class="the-objects col-md-12" style="width:150px;">
	<div class="img-block" style="background-image: url('http://collections.centerofthewest.org/zoomify/1/<?=str_replace(' ','_',$usergal['Usergal']['img'])?>/TileGroup0/0-0-0.jpg')">

			<div class="link">			
				<?=$this->Html->image('transparent.png',array('url'=>array('action' =>'view', $usergal['Usergal']['id'])))?>
			</div>
			
	</div><!-- /imgblock -->
</div><!-- /theobjects -->
</div>
<div class="col-sm-9">
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

