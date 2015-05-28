<div class="row">
<div class="col-xs-12 col-md-offset-1 col-md-9">
<h2>Reset your password</h2>
<?php
	echo $this->Form->create($model, array(
		'url' => array(
			'action' => 'reset_password',
			$token)));
	echo $this->Form->input('new_password', array(
		'label' =>false,
		'type' => 'password',
		'class'=>'form-control',
		'placeholder'=>'Enter new password'));
	echo $this->Form->input('confirm_password', array(
		'label' => false,
		'type' => 'password',
		'class'=>'form-control',
		'placeholder'=>'Confirm new password')).'<br />';
	echo $this->Form->submit(__d('users', 'Submit'));
	echo $this->Form->end();
?>
</div>
</div>