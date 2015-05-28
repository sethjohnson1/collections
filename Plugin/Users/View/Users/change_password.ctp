<?php
/**
 * Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<div class="row">
<div class="col-xs-12 col-md-offset-1 col-md-9">
<h2><?php echo 'Change your password'; ?></h2>
<p><?php echo __d('users', 'Please enter your old password because of security reasons and then your new password twice.'); ?></p>
	<?php
		echo $this->Form->create($model, array('action' => 'change_password'));
		echo $this->Form->input('old_password', array(
			'label' => false,
			'type' => 'password',
			'class'=>'form-control',
			'placeholder'=>'Current password'));
		echo $this->Form->input('new_password', array(
			'label' =>false,
			'type' => 'password',
			'class'=>'form-control',
			'placeholder'=>'New password'));
		echo $this->Form->input('confirm_password', array(
			'label' => false,
			'type' => 'password',
			'class'=>'form-control',
			'placeholder'=>'Confirm new password')).'<br />';
		echo $this->Form->end(__d('users', 'Submit'));
	?>
</div>
</div>