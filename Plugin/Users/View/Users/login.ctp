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
<div class="users index row">
<div class="col-xs-12">
<h4> <?=$this->Html->link('Click here to create an account',array('action'=>'add'))?> if you don't have one already—it's fast and free!</h4>
	<h2><?php echo __d('users', 'Login with e-mail'); ?></h2>
	<?php echo $this->Session->flash('auth');

	?>
	<fieldset>
		<?php
			echo $this->Form->create($model, array(
				'action' => 'login',
				'id' => 'LoginForm',
				//sj added next two lines, eventually this needs to have an IF statement to only do this when AJAX rendered
				//but it didn't work still so I commented out
				//'ajax'=>true,
				//'_redirect'=>false
				));
			echo $this->Form->input('email', array(
				'label' =>false,'class'=>'form-control','placeholder'=>'E-mail address'));
			echo $this->Form->input('password',  array(
				'label' => false,'class'=>'form-control','placeholder'=>'Password'));

			echo '<p>' . $this->Form->input('remember_me', array('class'=>'regular-checkbox','type' => 'checkbox', 'label' => false,'div'=>false)) . ' Remember me</p>';
			echo '<p>' . $this->Html->link(__d('users', 'I forgot my password'), array('action' => 'reset_password')) . '</p>';

			echo $this->Form->hidden('User.return_to', array(
				'value' => $return_to));
			echo $this->Form->end(__d('users', 'Submit'));
		?>
	</fieldset>
	</div>
</div>
