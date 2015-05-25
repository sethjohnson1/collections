<h2>Questions and Comments</h2>
<div class="row comments_box">
	<div class="col-xs-12 col-sm-10">
		
<? 
	$allow=1;
	$addbtn='Add';
	echo $this->Form->create('sComment',array('class'=>'sCommentViewForm'.$fk));
	//debug($comment['usercomments']['primary']);
	if (isset($comments['usercomments']['primary'])) {
		$thoughts=$comments['usercomments']['primary'];
		$labelcomment='Edit your comment and rating';
		$addbtn='Update';
	}
	else { 
		$thoughts='';
		$rating=3;
		$labelcomment='Add a comment and rating';
	}
	//echo heading here
	echo $this->Form->input('foreign_key',array('type'=>'hidden','value'=>$fk));		
	echo $this->Form->input('model',array('type'=>'hidden','value'=>$model));		
	
	//echo $this->Form->input('rating',array('type'=>'range','data-highlight'=>'true','min'=>'0','max'=>'5','value'=>$rating,'label'=>'Your Approval rating'));	
?>
<div class="form-group commentadd">
<?=$this->Form->input('comment',array('type'=>'textarea','rows'=>2,'value'=>$thoughts,'label'=>false,'class'=>'form-control commentadd','placeholder'=>'Add your comment here'))?>
</div>
	</div>
	<div class="col-xs-12 col-sm-2">

	<?
		if (isset($user['id'])){
		echo $this->Form->button($addbtn,array('type'=>'button','class'=>'btn btn-default comment_add'.$fk,'id'=>'comment_add','label'=>false));	
	}
	else {
		
		echo $this->Html->link('Login to comment','#login-modal',array('data-toggle'=>'modal')).'<br />';
	}
	echo $this->Form->end();
	?>
	</div>
</div>

<div class="big_comment_container row">
<div class="col-xs-12">

	<div class="comments<?=$model.$fk?>">

		<? 
		if(empty($user))$user='';
		echo $this->element('comments_widget',array($comments,$user));?>

	</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){     
    $(document).off('click', '.comment_add<?=$fk?>').on('click', '.comment_add<?=$fk?>',function(e) {
		$('.comments<?=$model.$fk?>').block({ message: 'One Moment'}); 
		$.ajax({
		async:true,
		data:$(".sCommentViewForm<?=$fk?>").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			$('.comments<?=$model.$fk?>').unblock();
			$(".comments<?=$model.$fk?>").html(data).trigger('create');
		},
		type:"POST",
		url:"<?='http://'.$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'comment_add'))?>"});
		event.preventDefault();
		return false;
    }); 
});
</script>