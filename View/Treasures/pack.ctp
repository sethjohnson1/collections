<?=$this->Form->create('Treasure',array('div'=>true))?>
<script type="text/javascript">
$(function() {	   
    $('input,textarea').not('.ignore').bind("change", function(){setConfirmUnload(true);});
    $('.ignore').click(function() {setConfirmUnload(false);});
});

$(document).ready(function(){

/*$('#sort_up').click(function() {
moveUp($(this).parents('.the-objects'));
});

$('#sort_down').click(function() {
moveDown($(this).parents('.the-objects'));
});
*/
/*
$('.sorting').click(function() {
    var btn = $(this);
    var val = btn.val();
	console.log(val);
    if (val == 'up')
        
    else
        
});
*/
});
 
</script>
<style>
.input-group{
	width:100%;
}
</style>
<div class="row">
<div class="col-xs-12">

</div>
<div class="col-sm-12">
<p><small>
<?
if (!empty($edit))  echo $this->Html->link(__('Delete this exhibit'), array('action' => 'dopack','d:all'),
 null, __('Are you sure you want to delete your virtual exhibit?')).' | '.$this->Html->link('New exhibit', array('controller'=>'treasures','action' => 'dopack','?'=>array('c'=>'true')),array(''), __('Unsaved changes to your existing exhibit will be lost. Are you ready to start a new exhibit?')).' | <a onclick="dropCookie(\'editflag\')" href="" >Clone items to new exhibit</a>';
 else {
 echo $this->Html->link('Load existing', array('controller'=>'usergals','action' => 'load')).' | ';
echo $this->Html->link('Start Over', array('controller'=>'treasures','action' => 'dopack','?'=>array('c'=>'true')),array(''), __('Are you sure you want to remove everything and start over?'));
}
?></small></p>
</div>
</div>
<div class="row">
	<div class="col-xs-12">
	<div class="input-group">

	<?=$this->Form->input('Usergal.name',array('div'=>false,'required'=>true,'placeholder'=>'Title of exhibit','label'=>false,'class'=>'form-control','style'=>'font-size:1.5em'))?>
	</div>
	</div>
	<div class="col-xs-12">
	<div class="input-group">

	<?=$this->Form->input('Usergal.gloss',array('placeholder'=>'Describe the exhibit','label'=>false,'type'=>'textarea','class'=>'form-control','rows'=>'2'))?>
	</div>
	</div>
</div>
<div class="row">
<div class="col-xs-6">
<h4 class="badge-orange">
<span style="font-size:1em" class="badge">
<? //=$this->Paginator->counter(array('format' => __('{:current} items '.$limit.' cases full')))?>
<span class="ExNum"></span> items
</span>
</h4>
</div>
<div class="col-xs-6 hidden-xs">
<h4>Drag and drop items to sort</h4>
</div>
</div>
<?

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
<div class="col-sm-12">
<div class="panel panel-default">
  <div class="panel-heading" style="background-color:#bd4f19;color:white;"><h1 class="panel-title">Final details</h1></div>
  <div class="panel-body">
    <div class="row">
	<div class="col-xs-12">
	<h4>Relax, your exhibit can easily be edited once saved</h4>
	<div class="input-group">
	<?
	$userval='';
	if (empty($user)):
	$logintxt='. '.$this->Html->link('Create an Account to skip this!','#login-modal',array('data-toggle'=>'modal'));
	echo $this->Form->input('Usergal.email',array('required'=>true,'div'=>false,'placeholder'=>'(for verification only)','label'=>'Valid e-mail, will not be shared'.$logintxt,'class'=>'form-control'));
	
	?>
	<br />
	<br />
	<br />
	<?
	elseif (isset($this->request->data['Usergal']['creator'])): $userval=$this->request->data['Usergal']['creator'];
	elseif (isset($user['username'])):
	$formattedname=explode('^',$user['username']);
	$formattedname[0]=str_replace('_',' ',$formattedname[0]);
	$userval=$formattedname[0];
	//echo $this->Form->input('Usergal.email',array('type'=>'hidden','value'=>$user['username']));
	endif;
	?>
	</div>
	</div>
	<div class="col-xs-12">
	<div class="input-group input-group-lg">
	<?=$this->Form->input('Usergal.creator',array('required'=>true,'placeholder'=>'(as you\'d like it displayed)','label'=>'Your name','class'=>'form-control','value'=>$userval))?>
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
	?>
	</div>
	</div>
	<style>
	.btn-danger{
		background-color:#035642;	
		font-size:1.3em;
		border: 0px ;
	}
	.btn-danger:hover{
		background-color: #bd4f19;
		
	}
	</style>
		<?
	$tosLink = $this->Html->link('terms of service', array('controller' => 'pages', 'action' => 'tos'));
		if(isset($edit) || isset($user)) :?>
		<div class="col-xs-6"><?
			//they already agreed so check the box for them
			//also we DON'T want to changed 'listed' value when editing or it's a loophole for chaos
			echo $this->Form->checkbox('tos',array('checked'=>true,'required'=>true,'div'=>'false','class'=>'regular-checkbox')).' I agree to '.$tosLink;?>
		</div>
		<div class="col-xs-6">
		<?
			//echo $this->Form->submit(__('Save exhibit'), array('div' => false,'class'=>'ignore btn btn-danger btn-lg'));
		?>
		</div>
		<?else :?>
		<div class="col-xs-6">
		<?
			//benefit of the doubt on new exhibits, if it becomes a problem we'll have to make this zero (or do something on the Model)
			echo $this->Form->input('Usergal.listed',array('type'=>'hidden','value'=>1));
			echo $this->Form->checkbox('tos',array('required'=>true,'div'=>'false','class'=>'regular-checkbox')).' I agree to '.$tosLink;?>
		</div>
		<div class="col-xs-6">
			<?
			?>
		</div>
		<?endif;
					echo $this->Form->submit('Save exhibit', array('div' => false,'class'=>'ignore btn btn-danger btn-lg"'));	
	?>
	</div>
  </div>
</div>
</div>


	
</div>
			     
<?=$this->Form->end()?>