<script type="text/javascript">
$(function() {	   
    $('input,textarea').not('.ignore').bind("change", function(){setConfirmUnload(true);});
    $('.ignore').click(function() {setConfirmUnload(false);});
    $( ".search-results" ).disableSelection();

	
}) 
</script>

<div class="pagging" style="float:left">	
<?php 
		echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>
<?php echo $this->Paginator->counter(array('format' => __('Showing {:current} records out of {:count}')));?>		
</div>       
    <div style="float:right;">
	    <?php echo $this->Html->link('Load an Exhibit', array('controller'=>'usergals','action' => 'load'));?>
    </div>
<div class="clear"></div>
<div class="treasure-search" style="width:100%;margin-top:5px;">
	<?php
echo $this->Form->create('Treasure',array('div'=>true,'default'=>true));
//add 'default'=>false for AJAX submit

//next two lines add AYAH and make it work with SecutiyComponent

if(!isset($edit)){
	echo $ayah;
}
$this->Form->unlockField('session_secret');
$opts=array();
foreach ($treasures as $tr) $opts[$tr['Treasure']['img']]=$tr['Treasure']['accnum'];
if(isset($edit)){
echo '<span id="flashMessage">You are editing an existing Virtual Exhibit.
<a onclick="dropCookie(\'editflag\')" href="" >Click here</a> to start a new exhibit with these objects.<br>
'.$this->Html->link('Click Here', array('controller'=>'treasures','action' => 'index'),array('onclick'=>'dropCookie("both");')).' to start a new Exhibit</span>';


echo '<div style="clear:both;margin:10 10px;"><br></div>';
 }

		
		
		echo '<div class="left">';
		echo $this->Form->input('Usergal.name',array('div'=>false,'required'=>true,'placeholder'=>'Title of your Exhibit','label'=>''));
		echo'</div>';

		echo '<div class="right">';
		echo $this->Form->input('Usergal.email',array('required'=>true,'div'=>false,'placeholder'=>'E-mail','label'=>''));
		echo'</div>';
		
		
		echo '<div style="clear:both;margin:10 10px;"><br></div>';
		echo '<div class="left">';
		echo $this->Form->input('Usergal.creator',array('required'=>true,'placeholder'=>'Your Name','label'=>''));
		echo'</div>';

		echo '<div class="right">';
		echo $this->Form->input('Usergal.gloss',array('placeholder'=>'Exhibit Label (Gloss)','label'=>''));
		echo '</div>';		
		//no, don't enable this or updates never seem to work
		echo $this->Form->input('Usergal.id');
		echo $this->Form->input('Usergal.editcode',array('type'=>'hidden'));
		echo $this->Form->input('Usergal.listed',array('type'=>'hidden','value'=>1));
		echo $this->Chosen->select('Usergal.img',$opts,	array('data-placeholder' => 'Pick featured object'));

		if(isset($edit))echo $this->Form->submit(__('Submit Changes'), array('div' => false,'class'=>'ignore'));			
		else echo $this->Form->submit('Submit', array('div' => false,'class'=>'mag','class'=>'ignore'));	
		
	//	echo $this->Html->script('sj_autocp1');
//		echo $this->Js->submit('Save', array('url'=>'respond.json','onClick'=>'console.log("hi")','data'=>'$(".basic-results").sortable("serialize")'));
		//echo $this->Html->script('sj_order');
		
		$this->Js->get('.search-results');
		$this->Js->sortable(array('placeholder'=>'ui-state-highlight','cursor'=>'move','tolerance'=>'pointer','update'=>'$("input.currentposition").each(function(idx){$(this).val(idx);});'));?>
        <script type="text/javascript">$(function() {$( ".search-results" ).disableSelection();});</script>
        <?

		
		echo $this->Js->writeBuffer();
 ?><div class="clear"></div><?
echo '<div class="left">';
if (!empty($edit))  echo $this->Html->link(__('Delete this Exhibit'), array('action' => 'dopack','d:all'),
 null, __('Are you sure you want to delete your Virtual Exhibit?')).'<br>';
echo $this->Html->link('Start Over', array('controller'=>'treasures','action' => 'index'),array('onclick'=>'dropCookie("both");'));
echo '<div class="right">'.$this->Html->link('Add More Objects', array('controller'=>'treasures','action' => 'index')).'</div>';?>
</div>
<div>

</div>

<div class="search-results" style="clear:both">
<?php
//this isn't working for me at all..
//$this->Js->get('.search-results');
/*
$this->Js->sortable(array(
    'distance' => 5,
    'containment' => 'parent',
    'start' => 'onStart',
    'complete' => 'onStop',
    'sort' => 'onSort',
    'wrapCallbacks' => false
));
$this->Js->each('alert("whoa!");', false);
$this->Js->writeBuffer(); */
?>
	<?php 
	   //  pr($treasures);

	foreach ($treasures as $key=>$treasure): 
	echo '<div class="the-objects" style="margin-bottom: 72px;" id="obj_'.$treasure['Treasure']['id'].'">';
	?>
   
   
  <!--  <div class="the-objects" style="margin-bottom: 72px;"> -->
	
	<?php  
	echo $this->Form->input('Usergal.sortord.'.$treasure['Treasure']['id'],array('type'=>'hidden','class'=>'currentposition','value'=>$key,'id'=>'UsergalComments_'.$treasure['Treasure']['id']));
		echo'<div class="img-block" style="background-image: url(http://remington.centerofthewest.org/zoomify/1/'.$treasure['Treasure']['img'].'/TileGroup0/0-0-0.jpg);">';
        echo $this->Form->input('Usergal.comments.'.$treasure['Treasure']['id'],array('label'=>false,'type'=>'textarea','cols'=>'14','rows'=>'3','div'=>false,'placeholder'=>'Object Comment'));		
         			echo '<div class="clear">&nbsp;</div>';	
    		echo '<div class="caption-pack">';	
			       echo '<div class="txt">'.$this->Html->link($treasure['Treasure']['accnum'],array('controller' => 'treasures', 'action' => 'view', $treasure['Treasure']['slug'])).'</div>';
         			echo '<div class="gal">';
						echo '<a id="gone" onclick="deleteCookie(\''.$treasure['Treasure']['id'].'\')"><img src="/img/x.png"></a>';					
					echo '</div>';
				echo'</div>';	
       echo '</div>';
        
        ?>
    
        
    
        <?php
        echo '</div>';
		//seth added q&d spacing for testing, otherwise draggin is maddening
		//echo '<span style="padding-right:30px;"></span>';

//	echo '<span style="padding-right:10px;"></span>';            ?>
    <?php endforeach; 
    
    
    ?>
    
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
<?php 
/*
$data = $this->Js->get('#TreasurePackForm')->serializeForm(array('isForm' => true, 'inline' => true));
$this->Js->get('#TreasurePackForm')->event(
   'submit',
   $this->Js->request(
    array('action' => 'pack', 'controller' => 'treasures'),
    array(
       // 'update' => '#contactStatus',
        'data' => $data,
        'async' => true,    
        'dataExpression'=>true,
        'method' => 'POST'
    )
  )
);
echo $this->Js->writeBuffer();
*/
echo $this->Form->end(); ?>