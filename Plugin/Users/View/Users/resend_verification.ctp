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
	<h2>Resend the E-mail Verification</h2>
	<p><?php echo __d('users', 'Please enter the e-mail you used for registration and you\'ll get an e-mail with further instructions.'); ?></p>
	<?php
	echo $this->Form->create($model, array(
		'url' => array(
			'admin' => false,
			'action' => 'resend_verification')));
	echo $this->Form->input('email', array('label'=>false,'placeholder'=>'Enter your e-mail','class'=>'form-control'));
	echo '<br />';
	echo $this->Form->submit(__d('users', 'Submit'));
	echo $this->Form->end();
	?>
	</div>
</div>
