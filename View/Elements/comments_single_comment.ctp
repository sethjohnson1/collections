<!-- this is double-wrapped so it can be reloaded in ajax yet easily controlled by widget -->
<div class="row">
<div class="col-xs-12">
<?
/* This is contained by the comments_widget, then refreshed with Ajax from CommentsUsers actions */
//debug($comment);
?>
<?

?>
<?if (isset($growl)):
if ($growl['type']=='success') $gtitle='<span style="color:green"><span class="glyphicon glyphicon-ok" style="text-align: left"></span><span style="text-align: right"> '.$growl['msg'].'</span></span>';
if ($growl['type']=='warning') $gtitle='<span style="color:yellow"><span class="glyphicon glyphicon-alert" style="text-align: left"></span><span style="text-align: right"> '.$growl['msg'].'</span></span>';
if ($growl['type']=='danger') $gtitle='<span style="color:red"><span class="glyphicon glyphicon-remove" style="text-align: left"></span><span style="text-align: right"> '.$growl['msg'].'</span></span>';
?>
<style scoped>

div.growlUI h1, div.growlUI h2 {
    color: white; font-size: 1em;
}   
</style>
<script>
$(document).ready(function() { 
   $('#growl_message').click(function() { 
       $.growlUI( '<?=$gtitle?>'); 
   }); 
   $( "#growl_message" ).trigger( "click" );
}); 
</script>
<a href="#" id="growl_message"></a>
<?endif?>
<div class="container<? echo $comment['Comment']['id'] ?>" >
<?

$flagged=false;
$mine='notmine';
$utoggle='enabled';
$dtoggle='enabled';
$upvoted=false;
$downvoted=false;
if (isset($comment['User']['username'])){
	$formattedname=explode('^',$comment['User']['username']);
	$formattedname[0]=str_replace('_',' ',$formattedname[0]);
}
else $formattedname[0]='A Guest';

echo $this->Form->create($comment['Comment']['id'],array('class'=>'form-inline comment'.$comment['Comment']['id']));
echo $this->Form->input('model',array('type'=>'hidden','value'=>$model));
echo $this->Form->input('foreign_key',array('type'=>'hidden','value'=>$fk));
//see if its their own comment
if (!empty($user['id']) && $comment['Comment']['user_id']==$user['id']) $mine='mine';
echo $this->Session->flash('commentFlash'.$comment['Comment']['id']);

if (isset($comment['CommentsUser']['id'])){
	//the user has interacted with this comment, set some useful variables
	$flagged=$comment['CommentsUser']['flagged'];
	$upvoted=$comment['CommentsUser']['upvoted'];
	$downvoted=$comment['CommentsUser']['downvoted'];
}


if ($flagged==true){
	$flagvalue=-1; //used later down in link
	$flaglabel='Unflag';
}
else {
	$flagvalue=1;
	$flaglabel='Flag';
	}
if (empty($comment['Comment']['downvotes'])) $comment['Comment']['downvotes']='0';
if (empty($comment['Comment']['upvotes'])) $comment['Comment']['upvotes']='0';

//see if there is a value to set for reply
$reply='';
$replybtn='Reply';
$replydis='disabled';
$replypl='You must login to reply';

if (isset($user['id'])){
	$replydis=false;
	$replypl='Reply to comment';
	if (isset($comments['usercomments'][$comment['Comment']['id']])){
		$reply=$comments['usercomments'][$comment['Comment']['id']]['thoughts'];
		echo $this->Form->input('reply_id',array('type'=>'hidden','value'=>$comments['usercomments'][$comment['Comment']['id']]['comment_id']));
		$replybtn='Update';
	}
}

//need a default value here.
$avatar='truckerhat-114.png';
if (!empty($comment['User']['email'])) $avatar=$this->Gravatar->get_gravatar($comment['User']['email'],true,$comment['User']['username']);
else if (!empty($comment['User']['picture'])) $avatar=$comment['User']['picture'];



	if($flagged==true ||  (isset($cookie_flags[$comment['Comment']['id']]) && empty($user['id']))){?>
	<div class="col-xs-12 well">
	<?
		
			$flaglabel='Unflag';
			echo $this->Form->input('pflag',array('type'=>'hidden','value'=>'unflag'));
			echo '<p><strong>You flagged this message as inappropriate.</strong> If you simply did not like the comment,
			please unflag and vote it down instead.</p>';?>
			<a href="#" style="color:white" class="allcaps btn btn-warning comment_flag<?=$comment['Comment']['id']?>"><span class="glyphicon glyphicon-flag"> Unflag</a>
			<br />
	</div>
	<?}
	else if ($comment['Comment']['flags']>=4 && !isset($reveal)){?>
	<div class="col-xs-12 well">
	<?
	
		echo $this->Form->input('pflag',array('type'=>'hidden','value'=>'reveal'));
		echo '<p>This comment has been flagged as inappropriate '.$comment['Comment']['flags'].' times.
			Tap the warning icon if you want to live dangerously and read it.</p>';
		?>
		<a href="#" style="color:white" class="allcaps btn btn-warning comment_flag<?=$comment['Comment']['id']?>"><span class="glyphicon glyphicon-eye-open"> Reveal</a>
	</div>
	<?
	}
	
	else{
		//giant block to draw the comment and buttons
		?>
		<style>
			
		</style>

		<div class="row the_comment">
		
		<div class="col-xs-1 comment_buttons">
		<div style="float: left">
		<span class="upvote vote badge-hov">
			<? 
			
			//echo $this->Form->input('UpVote',array('div'=>false,'label'=>false,'type'=>'button','class'=>'comment_up'.$comment['Comment']['id'],$utoggle));?>
			
			<? if ($upvoted==true) : ?>
			<span title="You upvoted this" class="glyphicon glyphicon-triangle-top" style="color:<?=$color['green']?>; font-size: 2em;"></span><br/><small><span style="background-color:<?=$color['green']?>; color: white" class="upoffset badge badge-hov"><?=$comment['Comment']['upvotes'] ?></span></small>
			<?else:?>
			
			<a title="Upvote this comment" href="#" class="comment_up<?=$comment['Comment']['id']?>"><span class="glyphicon glyphicon-triangle-top" style="font-size: 2em;"></span><br /><small><span class="upoffset badge badge-hov"><?=$comment['Comment']['upvotes'] ?></span></small></a>
			
			<?endif?>
		
		</span>
		<br />
		<? //=$comment['Comment']['diff'] ?>
		<span class="downvote vote badge-hov">
				
			<? if ($downvoted==true) : ?>
			<small><span style="background-color:<?=$color['red']?>; color: white" class="downoffset badge badge-hov"><?=$comment['Comment']['downvotes'] ?></span></small><br />
			<span title="You downvoted this" class=" glyphicon glyphicon-triangle-bottom" style="color:<?=$color['red']?>; font-size: 2em;"></span>
			<?else:?>
			
			<a title="Downvote this comment" href="#" class="comment_down<?=$comment['Comment']['id']?>"><small><span class="downoffset badge badge-hov"><?=$comment['Comment']['downvotes'] ?></span></small><br /><span class="glyphicon glyphicon-triangle-bottom" style="font-size: 2em;"></span></a>
			<?endif?>
			
		</span>

	</div>
	</div><!-- /comment_buttons -->

		<div class="col-xs-8 comment_text">
		<?=$this->Html->image($avatar,array('alt'=>'user avatar','style'=>'width:60px;float:left; padding-right:5px;','class'=>'img-responsive img-rounded'))?>
		
		<p><strong><?=$formattedname[0] ?>'s</strong> deep thoughts</p>


		<p><?=$comment['Comment']['thoughts'] ?></p>

		<?if ($mine!='mine'){
			if (isset($comment['children'])&&(!isset($comment['count']) || $comment['count']<3)){?>
		 <div class="col-md-offset-1 form-group">
		<?=$this->Form->input('reply'.$comment['Comment']['id'],array('class'=>'form-control','placeholder'=>$replypl,'label'=>false,'type'=>'textarea','rows'=>1,'cols'=>27,'value'=>$reply,'disabled'=>$replydis))?>
		</div>
			  <?
			echo $this->Form->input($replybtn,array(
				'div'=>false,'label'=>false,
				'type'=>'button',
				'class'=>'btn btn-default comment_reply'.$comment['Comment']['id'],
				'disabled'=>$replydis
				
			));
			?>
			
			<?
		}
		}		//end reply section IF
		?>

		
		

		</div><!-- /row -->
	<div class="col-xs-2">
	<h3>
	<?		if ($mine=='mine'){ ?>
			<a href="#" role="button" class="btn btn-default orange-btn comment_hide<?=$comment['Comment']['id']?>">
			<span class="glyphicon glyphicon-remove">	Hide</span>
			</a>
		
			<?
			}
		else {
		echo $this->Form->input('pflag',array('type'=>'hidden','value'=>'flag'));
		?>
		<a href="#" role="button" style="" title="<?=$flaglabel?> this comment" class="orange-btn btn btn-default comment_flag<?=$comment['Comment']['id']?>"><span class="glyphicon glyphicon-alert"> Flag</span></a>
		<?}?>
	</h3>
	</div>
</div><!-- /the_comment -->

	<?	} //end of the else. The colon method doesn't work as well with nested IF above ?>



<? 		echo $this->Form->input('flagvalue',array('type'=>'hidden','value'=>$flagvalue));
		echo $this->Form->end(); 
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
$('.comments<?=$model.$fk?>').block({ message: null}); 
	$.ajax({
	async:true,
	data:$(".comment<?=$comment['Comment']['id']?>").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$('.comments<?=$model.$fk?>').unblock();
		$(".comments<?=$model.$fk?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<?='http://'.$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'comment_reply',$comment['Comment']['id'],$model,$fk))?>"});
	return false;
});

<?

$flagclass='.container'.$comment['Comment']['id'];

?>

$(document).off('click', '.comment_flag<?=$comment['Comment']['id']?>').on('click', '.comment_flag<?=$comment['Comment']['id']?>',function(e) {
$('<?=$flagclass?>').block({ message: null}); 
	$.ajax({
	async:true,
	data:$(".comment<?=$comment['Comment']['id']?>").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$('<?=$flagclass?>').unblock();
		$("<?=$flagclass?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
		 
	},
	
	type:"POST",
	url:"<?='http://'.$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'comment_flag',$comment['Comment']['id'],$model,$fk))?>"});
	return false;
});

</script>
</div><!-- /comment_container -->
</div><!-- /end giant col-xs-12 -->
</div><!-- /end giant row -->