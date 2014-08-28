<script type="text/javascript">
$(function() {	   
	$("a#btn").click(function(){
		$('.hidden').toggle();
		$('.tog').toggle();
	
	 });
}) 
</script>

<?php
if(!empty($scr)) echo $scr;
				
echo $this->Form->create('Load');
if(!$this->Session->read('Auth.User'))
	echo $ayah;
$this->Form->unlockField('session_secret');
echo '<div class="tog">';
echo 'Enter the code to edit your Virtual Gallery. This code was e-mailed to you when you created your gallery.';
echo $this->Form->input('editcode',array('label'=>'Edit Code Emailed to you: '));
echo '<a href="#" id="btn">Lost your edit code?</a>';
echo '</div>';



echo '<div class="hidden">';
echo 'Enter your e-mail and we will try to email you your edit code ';
echo $this->Form->input('email',array('label'=>'Email: '));
echo '<a href="#" id="btn">Load your Exhibit?</a>';
echo '</div>';
echo $this->Form->submit('Submit',array('div' => true));	
echo $this->Form->end();
?>