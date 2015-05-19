<div class="row comments_box">
	<div class="col-xs-12">
<? 
	$allow=1;
	echo $this->Form->create('sComment',array('class'=>'sCommentViewForm'.$fk));
	if (isset($usercomment['Comment']['thoughts'])) {
		$thoughts=$usercomment['Comment']['thoughts'];
		$rating=$usercomment['Comment']['rating'];
		$labelcomment='Edit your comment and rating';
	}
	else { 
		$thoughts='';
		$rating=3;
		$labelcomment='Add a comment and rating';
	}
	//echo heading here
	echo $this->Form->input('foreign_key',array('type'=>'hidden','value'=>$fk));		
	echo $this->Form->input('model',array('type'=>'hidden','value'=>$model));		
	
	echo $this->Form->input('rating',
		array('type'=>'range','data-highlight'=>'true','min'=>'0','max'=>'5','value'=>$rating,'label'=>'Your Approval rating'));		
	echo $this->Form->input('comment',array('type'=>'textarea','value'=>$thoughts,'label'=>'Your thoughts'));		
	if (isset($user['id'])){
		echo $this->Form->button('Add',array('type'=>'button','class'=>'comment_add'.$fk,'id'=>'comment_add','label'=>false));	
	}
	else {
		$loginlink = $this->Html->link('Login is simple.','#userPopup',array('data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'pop'));
		echo 'To ensure the fidelity of information supplied, you must login first.<br />'
		.$loginlink.'<br />';
	}
		//echo $this->Form->submit('Submit',array('id'=>'submit_button'));
	echo $this->Form->end();
	?>
	</div>
</div>

<div class="big_comment_container row">
<div class="col-xs-12">
	<h2>Comment and Rate</h2>

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
		$.ajax({
		async:true,
		data:$(".sCommentViewForm<?=$fk?>").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			$(".comments<?=$model.$fk?>").html(data).trigger('create');
		},
		type:"POST",
		url:"<?='http://'.$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'comment_add'))?>"});
		event.preventDefault();
		return false;
    }); 
});
</script>