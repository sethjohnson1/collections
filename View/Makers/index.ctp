<div class="row">
<div class="col-sm-12">
	<?php
    	echo $this->Form->create('Maker');
	    echo $this->Form->input('name', array('div' => false,'label'=>false,'type'=>'text','placeholder'=>'Search for Makers','class'=>'searchbox form-control'));
		echo $this->Form->submit('/img/glass.png', array('div' => false,'class'=>'search-btn'));		

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
<? 
$cnt =$this->Number->format($this->Paginator->counter(array('format' => __('{:count}'))));
echo $this->Paginator->counter(array('format' => __('Viewing records {:start} to {:end} out of '.$cnt)));
?>

</div>

<?=$this->Form->end()?>	
  
</div>
</div>    

<div class="search-results">
<?php foreach ($makers as $maker): ?>
<div class="the-objects">
	<?php				
echo'<div class="img-block" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',$maker['Maker']['img']).'/TileGroup0/0-0-0.jpg\');">';
//have to use a cookie for maker name, better for performance anyway
$mk = preg_replace("/[^ \w]+/", "", $maker['Maker']['name']);
			echo '<div class="link">';			
				echo $this->Html->image('transparent.png',array('onclick'=>'makerCook(\''.$mk.'\')','url'=>array('controller'=>'treasures','action' => 'index','makers'=>$maker['Maker']['slug'])));
			echo'</div>';
			
			echo '<div class="caption">';

				echo '<div class="txt">';
				{
					if(strlen($maker['Maker']['name'])>=39)
						echo $this->Html->link(substr($maker['Maker']['name'],0,38).'...', array('controller'=>'treasures','action' => 'index','makers'=>$maker['Maker']['id']),array('onclick'=>'makerCook(\''.$mk.'\')'));
					else
						echo $this->Html->link($maker['Maker']['name'], array('controller'=>'treasures','action' => 'index','makers'=>$maker['Maker']['id']),array('onclick'=>'makerCook(\''.$mk.'\')'));

				}
			
            echo'</div>';
	echo '</div>';
echo '</div>';
		
echo '</div>';?>
<?php endforeach; ?>
</div>
<?=$this->element('paging')?>
<div style="margin-top:20px;">&nbsp;</div>



