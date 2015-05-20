<div class="row container<? echo $comment['Comment']['id'] ?>" >
<?

$flagged=false;
$mine='notmine';
$utoggle='enabled';
$dtoggle='enabled';
$upvoted=false;
$downvoted=false;
if (isset($comment['Comment']['User']['username'])){
	$formattedname=explode('^',$comment['Comment']['User']['username']);
	$formattedname[0]=str_replace('_',' ',$formattedname[0]);
}
else $formattedname[0]='SethTest';

echo $this->Form->create($comment['Comment']['id'],array('class'=>'comment'.$comment['Comment']['id']));
echo $this->Form->input('model',array('type'=>'hidden','value'=>$model));
echo $this->Form->input('foreign_key',array('type'=>'hidden','value'=>$fk));
//see if its their own comment
if (!empty($user['id']) && $comment['Comment']['user_id']==$user['id']) $mine='mine';
else echo $this->Session->flash('commentFlash');

if (isset($comment['CommentsUser']['id'])){
	//the user has interacted with this comment, set some useful variables
	$flagged=$comment['CommentsUser']['flagged'];
	$upvoted=$comment['CommentsUser']['upvoted'];
	$downvoted=$comment['CommentsUser']['downvoted'];
}

if ($upvoted==true) $utoggle='disabled';
if ($downvoted==true) $dtoggle='disabled';
if ($flagged==true){
	$flagvalue=-1; //used later down in link
	$flaglabel='Unflag';
}
else {
	$flagvalue=1;
	$flaglabel='Flag';
	}
//someday this could be combined a little, this is one Meal of an IF statement and is used Twice!
/*if(($flagged==true || $comment['Comment']['flags']>=4) ||
 (isset($cookie_flags[$comment['Comment']['id']]) && empty($user['id']) )) $cheight=100;
else 
*/

	if($flagged==true ||  (isset($cookie_flags[$comment['Comment']['id']]) && empty($user['id']))){?>
	<div class="col-xs-12">
	<?
		
			$flaglabel='Unflag';
			echo $this->Form->input($flaglabel,array(
				'div'=>false,
				'type'=>'button',
				'label'=>false,
				'class'=>'ui-btn-icon-notext ui-mini ui-icon-alert fsign'.' comment_flag'.$comment['Comment']['id'],
				'style'=>'float:left'
				));
			
			echo $this->Form->input('pflag',array('type'=>'hidden','value'=>'unflag'));
			echo '<p><strong>You flagged this message as inappropriate.</strong> If you simply did not like the comment,
			please unflag and vote it down instead.</p>';?>
		</div>
	<?}
	else if ($comment['Comment']['flags']>=4 && !isset($reveal)){?>
	<div class="col-xs-12">
	<?
	
		echo $this->Form->input('Reveal',array(
			'div'=>false,
			'type'=>'button',
			'label'=>false,
			'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert fsign'.' comment_flag'.$comment['Comment']['id'],
			'style'=>'float:left'
			));
		echo $this->Form->input('pflag',array('type'=>'hidden','value'=>'reveal'));
		echo '<p>This comment has been flagged as inappropriate '.$comment['Comment']['flags'].' times.
			Tap the warning icon if you want to live dangerously and read it.</p>';
		?>
	</div>
	<?
	}
	
	else{
		//giant block to draw the comment and buttons
		?>
		

		<div class="row the_comment">
		
		<div class="col-xs-3 comment_buttons">
		<div class="votes">
			<? echo $this->Form->input('UpVote',array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'arrow-u',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'comment_up'.$comment['Comment']['id'],
			$utoggle
		));?>
		<div class="upvote"><?=$comment['Comment']['upvotes']?></div>
		</div>
		<?
		//color the total..
		$voteclass='';
		if ($comment['Comment']['diff'] > 0) $voteclass='upvote';
		if ($comment['Comment']['diff'] < 0) $voteclass='downvote';
		?>
		<div class="total <?=$voteclass?>"><span class="diff"><?=$comment['Comment']['diff'] ?></span></div>
		<div class="votes" >
		
		<? echo $this->Form->input('DownVote',array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'arrow-d',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'comment_down'.$comment['Comment']['id'],
			$dtoggle
		));			
		?>
		
		<div class="downvote"><?=$comment['Comment']['downvotes'] ?></div>
		</div>
		<div class="votes">
		<?	echo $this->Form->input($flaglabel,array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'alert',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'delbtn comment_flag'.$comment['Comment']['id']
		));
		echo $this->Form->input('pflag',array('type'=>'hidden','value'=>'flag'));
		?>
		</div>
		
	</div><!-- /comment_buttons -->

		<div class="col-xs-9 comment_text">
		<div class="comment_header">
		<div class="comment_rate">
				<strong><?=$formattedname[0] ?></strong>
		
		
		<?
		for ($x=0;$x<=4; $x++):
			if ($comment['Comment']['rating'] > $x) $starred='starred';
			else $starred='';
			
		?>
		<span class="ui-icon-star ui-btn-icon-notext staricon <? echo $starred ?>"/></span>

		<?
		endfor;
		?>
		
		</div>
		<div class="comment_destructive"><?


		
		if ($mine=='mine'){
			echo $this->Form->input('Delete my Comment',array(
				'div'=>false,'label'=>false,
				'type'=>'button',
				'data-role'=>'button',
				'data-icon'=>'delete',
				'data-iconshadow'=>'true',
				'data-iconpos'=>'notext',
				'data-corners'=>'false',
				'class'=>'comment_hide'.$comment['Comment']['id'],
				'rel'=>'external',
				'data-ajax'=>'false',
				'style'=>''
				
			));
		}
		else {
			echo $this->Form->input('Reply',array(
				'div'=>false,'label'=>false,
				'type'=>'button',
				'class'=>'comment_reply'.$comment['Comment']['id'],
				'style'=>''
				
			));
			echo $this->Form->input('reply'.$comment['Comment']['id'],array('class'=>'form-control','placeholder'=>'Reply to comment','label'=>false));
		}
		?> </div>
		</div>
		
		

		<div class="comment_thoughts"><? echo $comment['Comment']['thoughts'] ?></div>
		</div>
		<!-- /div -->
		</div><!-- /the_comment -->

	<?	} //end of the else. The colon method doesn't work as well with nested IF above ?>



<? 		echo $this->Form->input('flagvalue',array('type'=>'hidden','value'=>$flagvalue));
		echo $this->Form->end(); 
		//debug($comment);
 ?>

<? //in theory not all are needed if comment is flagged, but too much to worry about now 
//also, only the "reply" properly serializes the form, the others just use the URL, but its easier that way for testing sometimes anyway
?>
<script type="text/javascript">
      
$(document).off('click', '.comment_hide<?=$comment['Comment']['id']?>').on('click', '.comment_hide<?=$comment['Comment']['id']?>',function(e) {
	$.ajax({
	async:true,
	data:$(".<?=$comment['Comment']['id']?>CommentAddForm").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$(".comments<?=$model.$fk?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<?='http://'.$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'comment_hide',$comment['Comment']['id'],$model,$fk))?>"});
	return false;
}); 

$(document).off('click', '.comment_up<?=$comment['Comment']['id']?>').on('click', '.comment_up<?=$comment['Comment']['id']?>',function(e) {
	$.ajax({
	async:true,
	data:$(".<?=$comment['Comment']['id']?>CommentAddForm").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$(".container<?=$comment['Comment']['id'] ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<?='http://'.$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'comment_up',$comment['Comment']['id'],1,$model,$fk))?>"});
	return false;
});

$(document).off('click', '.comment_down<?=$comment['Comment']['id']?>').on('click', '.comment_down<?=$comment['Comment']['id']?>',function(e) {
	$.ajax({
	async:true,
	data:$(".<?=$comment['Comment']['id']?>CommentAddForm").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$(".container<?=$comment['Comment']['id']?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<?='http://'.$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'comment_up',$comment['Comment']['id'],'-1',$model,$fk))?>"});
	return false;
});

$(document).off('click', '.comment_reply<?=$comment['Comment']['id']?>').on('click', '.comment_reply<?=$comment['Comment']['id']?>',function(e) {
	$.ajax({
	async:true,
	data:$(".comment<?=$comment['Comment']['id']?>").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$(".container<?=$comment['Comment']['id']?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<?='http://'.$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'comment_reply',$comment['Comment']['id'],$model,$fk))?>"});
	return false;
});

<?

$flagclass='.container'.$comment['Comment']['id'];

?>

$(document).off('click', '.comment_flag<?=$comment['Comment']['id']?>').on('click', '.comment_flag<?=$comment['Comment']['id']?>',function(e) {
	$.ajax({
	async:true,
	data:$(".comment<?=$comment['Comment']['id']?>").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$("<?=$flagclass?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<?='http://'.$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'comment_flag',$comment['Comment']['id'],$model,$fk))?>"});
	return false;
});

</script>
</div><!-- /comment_container -->
<hr />