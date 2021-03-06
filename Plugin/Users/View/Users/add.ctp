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
<h4> If you already have an account, <?=$this->Html->link('log-in now',array('action'=>'login'))?>!</h4>
	<h2>Register with e-mail	</h2>

	<p>E-mail addresses are not displayed publicly or shared</p>
		<?php
			echo $this->Form->create($model);
			echo $this->Form->input('username', array(
				'label' => false,
				'class'=>'form-control',
				'placeholder'=>'Display name'));
			echo $this->Form->input('email', array(
				'label' => false,
				'error' => array('isValid' => __d('users', 'Must be a valid e-mail address'),
				'isUnique' => __d('users', 'An account with that e-mail already exists'))
				,'class'=>'form-control',
				'placeholder'=>'E-mail address (used as login)'
				));
			echo $this->Form->input('password', array(
				'label' => false,
				'type' => 'password',
				'class'=>'form-control',
				'placeholder'=>'Password'
				));
			echo $this->Form->input('temppassword', array(
				'label' =>false,
				'type' => 'password',
				'class'=>'form-control',
				'placeholder'=>'Confirm password'
				));
			$tosLink = $this->Html->link(__d('users', 'terms of service'), array('controller' => 'pages', 'action' => 'tos', 'plugin' => null));
			echo $this->Form->input('tos', array(
				'label' => false,
				'div'=>false,
				'class'=>'regular-checkbox'
				)).' I agree to the '.$tosLink;
			echo $this->Form->end(__d('users', 'Submit'));
		?>
</div>
</div>
