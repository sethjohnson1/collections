<script type="text/javascript">
$(function() {	   
    $('input,textarea').not('.ignore').bind("change", function(){setConfirmUnload(true);});
    $('.ignore').click(function() {setConfirmUnload(false);});
}) 
</script>
<style>
.input-group{
	width:100%;
}
</style>
<?
$words='Build your exhibit <span style="font-size: .5em">[ '.$this->Html->link('Load existing', array('controller'=>'usergals','action' => 'load')).' ]</span>';
if(isset($edit)){
echo '<span id="flashMessage">You are editing an existing Virtual Exhibit.
<a onclick="dropCookie(\'editflag\')" href="" >Click here</a> to start a new exhibit with these objects.<br>
'.$this->Html->link('Click Here', array('controller'=>'treasures','action' => 'index'),array('onclick'=>'dropCookie("both");')).' to start a new Exhibit</span>';
$words='Edit your exhibit';
}?>

<h1><?=$words?>
</h1>

<h4 class="badge-orange">
<span style="font-size:1em" class="badge"><?=$this->Paginator->counter(array('format' => __('{:current} \ '.$limit.' possible')))?></span> <br /> 
Drag items to sort</h4>
<?
echo $this->Form->create('Treasure',array('div'=>true));
echo $this->Form->input('Usergal.id');
echo $this->Form->input('Usergal.editcode',array('type'=>'hidden'));
$this->Js->get('.search-results');
$this->Js->sortable(array('placeholder'=>'ui-state-highlight','cursor'=>'move','tolerance'=>'pointer','update'=>'$("input.currentposition").each(function(idx){$(this).val(idx);});'));?>
<script type="text/javascript">$(function() {$( ".search-results" ).disableSelection();});</script>
<? 
echo $this->Js->writeBuffer();		

//echo $this->Html->script('sj_autocp1');
?>
<div class="row">
<div class="col-xs-12">
<div class="row search-results">
<?	foreach ($treasures as $key=>$treasure): ?>


<div class="the-objects col-xs-4" style="margin-bottom: 72px; padding-top:27px" id="obj_'<?=$treasure['Treasure']['id']?>">

<?=$this->Form->input('Usergal.sortord.'.$treasure['Treasure']['id'],array('type'=>'hidden','class'=>'currentposition','value'=>$key,'id'=>'UsergalComments_'.$treasure['Treasure']['id']))?>
	
		<div  class="img-block" style="background-image: url('http://collections.centerofthewest.org/zoomify/1/<?=str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img']))?>/TileGroup0/0-0-0.jpg');">
		
		<?=$this->Form->input('Usergal.comments.'.$treasure['Treasure']['id'],array('label'=>false,'type'=>'textarea','cols'=>'14','rows'=>'3','div'=>false,'placeholder'=>'Object Comment'))?>
		
         <div class="clear">&nbsp;</div>
    	<div class="caption-pack">
			<div class="txt"><?=$this->Html->link($treasure['Treasure']['accnum'],array('controller' => 'treasures', 'action' => 'view', $treasure['Treasure']['slug']))?>
			</div>
         	<div class="gal">
			<a id="gone" onclick="deleteCookie('<?=$treasure['Treasure']['id']?>')"><?=$this->Html->image('x.png')?></a>					
			</div>
		</div>	
       </div>
 

</div>

    <?php endforeach; 
    
    
    ?>
	</div>
</div>
</div>
<br />
<div class="row">
<div class="col-sm-6">
<div class="panel panel-default">
  <div class="panel-heading"><h1 class="panel-title">Curator details</h1></div>
  <div class="panel-body">
    <div class="row">
	<div class="col-xs-12">
	<div class="input-group">
	<?=$this->Form->input('Usergal.email',array('required'=>true,'div'=>false,'placeholder'=>'(for verification only)','label'=>'Valid e-mail, will not be shared','class'=>'form-control'))?>
	</div>
	</div>
	<br />
	<br />
	<br />
	<div class="col-xs-12">
	<div class="input-group input-group-lg">
	<?=$this->Form->input('Usergal.creator',array('required'=>true,'placeholder'=>'(as you\'d like it displayed)','label'=>'Your name','class'=>'form-control'))?>
	</div>
	</div>
	</div>
  </div>
</div>
</div>
<div class="col-sm-6">
<div class="panel panel-default">
  <div class="panel-heading"><h1 class="panel-title">Exhibit information</h1></div>
  <div class="panel-body">
    <div class="row">
	<div class="col-xs-12">
	<div class="input-group">

	<?=$this->Form->input('Usergal.name',array('div'=>false,'required'=>true,'placeholder'=>'(pick something catchy)','label'=>'Title of your exhibit','class'=>'form-control'))?>
	</div>
	</div>
	<div class="col-xs-12">
	<div class="input-group">

	<?=$this->Form->input('Usergal.gloss',array('placeholder'=>'(optional, but much cooler if filled in)','label'=>'Describe your exhibit','type'=>'textarea','class'=>'form-control'))?>
	</div>
	</div>
	<div class="col-xs-12">
	<div class="input-group">

	<style media="screen" type="text/css">
	.select2-results {max-height: 350px;}
	</style>
		<?
		$opts=array();
		foreach ($treasures as $tr) $opts[$tr['Treasure']['img']]=$tr['Treasure']['accnum'];
		echo '<br />Thumbnail: '.$this->Form->input('Usergal.img',array('options'=>$opts,'label'=>'')).'<br />';
	$tosLink = $this->Html->link('terms of service', array('controller' => 'pages', 'action' => 'tos'));
		if(isset($edit)) {
			//they already agreed so check the box for them
			echo $this->Form->input(' ',array('label'=>'I agree to the ' .$tosLink.'<br>','type'=>'checkbox','required'=>true,'checked'=>'checked'));
			echo $this->Form->submit(__('Submit Changes'), array('div' => false,'class'=>'ignore'));
		}
		else {
			//benefit of the doubt on new exhibits, if it becomes a problem we'll have to make this zero (or do something on the Model)
			echo $this->Form->input('Usergal.listed',array('type'=>'hidden','value'=>1));
			//echo $this->Form->input(' ',array('label'=>'I agree to ' .$tosLink.'<br>','type'=>'checkbox','required'=>true));
			echo $this->Form->checkbox('tos',array('required'=>true,'div'=>'false','class'=>'regular-checkbox')).' I agree to '.$tosLink.'<br />';
			echo $this->Form->submit('Submit', array('div' => false,'class'=>'mag','class'=>'ignore'));	
		}?>
	</div>
	</div>
	</div>
  </div>
</div>
</div>
<div class="col-sm12">
<?
if (!empty($edit))  echo $this->Html->link(__('Delete this Exhibit'), array('action' => 'dopack','d:all'),
 null, __('Are you sure you want to delete your Virtual Exhibit?')).'<br>';
echo $this->Html->link('Start Over', array('controller'=>'treasures','action' => 'dopack','?'=>array('c'=>'true')),array(''), __('Are you sure you want to remove everything and start over?'))?>

<?=$this->Form->end(); ?>
</div>
</div>
			     
