<script type="text/javascript">
$(function() {	   
    $('input,textarea').not('.ignore').bind("change", function(){setConfirmUnload(true);});
    $('.ignore').click(function() {setConfirmUnload(false);});
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
	    <?php echo $this->Html->link('Edit your Virtual Exhibit', array('controller'=>'usergals','action' => 'load'));?>
    </div>
<div class="clear"></div>
<div class="treasure-search" style="width:100%;margin-top:5px;">
	<?php
echo $this->Form->create('Treasure',array('div'=>true));
//add 'default'=>false for AJAX submit

//add AYAH and make it work with SecutiyComponent, comment out to disable

if(!$this->Session->read('Auth.User')){
	if(!isset($edit)){
		//AYAH is disabled because it stopped working for some reason. Furthermore, I'd like to move to a simple MathCaptcha
		//echo $ayah;
	}
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
		echo $this->Form->input('Usergal.gloss',array('placeholder'=>'Describe your Virtual Exhibit (Gloss)','label'=>'','type'=>'textarea'));
		echo '</div>';
		echo $this->Form->input('Usergal.id');
		echo $this->Form->input('Usergal.editcode',array('type'=>'hidden'));
?>		<div class="clear"></div>		<?
		echo '<div class="left">';
		echo '<style media="screen" type="text/css">';
		echo '.select2-results {
					max-height: 350px;
				}';
		echo '</style>';
		echo $this->Form->input('Usergal.img',array('options'=>$opts,'label'=>'Pick a featured object'));
		echo '</div>';
		echo '<div class="right">';
		$tosLink = $this->Html->link('Terms of Service', array('controller' => 'pages', 'action' => 'tos'));
		if(isset($edit)) {
			//they already agreed so check the box for them
			echo $this->Form->input(' ',array('label'=>'I agree to ' .$tosLink.'<br>','type'=>'checkbox','required'=>true,'checked'=>'checked'));
			echo $this->Form->submit(__('Submit Changes'), array('div' => false,'class'=>'ignore'));
		}
		else {
			//benefit of the doubt on new exhibits, if it becomes a problem we'll have to make this zero (or do something on the Model)
			echo $this->Form->input('Usergal.listed',array('type'=>'hidden','value'=>1));
			echo $this->Form->input(' ',array('label'=>'I agree to ' .$tosLink.'<br>','type'=>'checkbox','required'=>true));
			echo $this->Form->submit('Submit', array('div' => false,'class'=>'mag','class'=>'ignore'));	
		}
		echo'</div>';		
		$this->Js->get('.search-results');
		$this->Js->sortable(array('placeholder'=>'ui-state-highlight','cursor'=>'move','tolerance'=>'pointer','update'=>'$("input.currentposition").each(function(idx){$(this).val(idx);});'));?>
        <script type="text/javascript">$(function() {$( ".search-results" ).disableSelection();});</script>
        <? 	echo $this->Js->writeBuffer();
		echo $this->Html->script('sj_autocp1');?>
<div class="clear"></div>
<? echo '<div class="left">';
if (!empty($edit))  echo $this->Html->link(__('Delete this Exhibit'), array('action' => 'dopack','d:all'),
 null, __('Are you sure you want to delete your Virtual Exhibit?')).'<br>';
echo $this->Html->link('Start Over', array('controller'=>'treasures','action' => 'index'),array('onclick'=>'dropCookie("both");')).'<br>';
echo '<div class="right">'.$this->Html->link('Add More Objects', array('controller'=>'treasures','action' => 'index')).'</div>';?>
</div>
<div>
</div>

<div class="search-results" style="clear:both">
<p>Drag and drop items to sort</p>
	<?php 
	   //  pr($treasures);

	foreach ($treasures as $key=>$treasure): 
	echo '<div class="the-objects" style="margin-bottom: 72px;" id="obj_'.$treasure['Treasure']['id'].'">';
	echo $this->Form->input('Usergal.sortord.'.$treasure['Treasure']['id'],array('type'=>'hidden','class'=>'currentposition','value'=>$key,'id'=>'UsergalComments_'.$treasure['Treasure']['id']));
		echo'<div class="img-block" style="background-image: url(\'http://collections.centerofthewest.org/zoomify/1/'.str_replace(' ','_',str_replace('#','',$treasure['Treasure']['img'])).'/TileGroup0/0-0-0.jpg\');">';
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

        ?>
    
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