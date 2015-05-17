<script type="text/javascript">
$(function() {	   
	$("a#btn").click(function(){
		$('.email_form').toggle();
		$('.tog').toggle();
	
	 });
}) 
</script>

<?php
if(!empty($scr)) echo $scr;
				
echo $this->Form->create('Load');
//if(!$this->Session->read('Auth.User'))
?>

<div class="row tog">
<div class="col-xs-12">
<h4>Enter the code e-mailed to you when you created your gallery</h4>
<?=$this->Form->input('editcode',array('placeholder'=>'Enter code','label'=>false,'class'=>'form-control'))?>
<?=$this->Form->submit('Submit',array('div' => true))?>
<a href="#" id="btn">Lost your edit code?</a>
</div>
</div>



<div class="row email_form" style="display:none">
<div class="col-xs-12">
<h4>Enter your e-mail and we will try to email you your edit code</h4>
<?=$this->Form->input('email',array('label'=>false,'placeholder'=>'Your email','class'=>'form-control'))?>
<?=$this->Form->submit('Submit',array('div' => true))?>
<a href="#" id="btn">Load your Exhibit?</a>
</div>
</div>

<div class="row">
<div class="col-xs-12">
<?	
echo $this->Form->end();
?>
</div>
</div>