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
<div class="users form">
<h2>Edit Account Details</h2>
	<?php echo $this->Form->create($model); ?>
		<fieldset>

			<?php
				echo $this->Form->input('UserDetail.first_name');
				echo $this->Form->input('UserDetail.last_name');
				echo $this->Form->input('UserDetail.birthday');
			?>
			<p>
				<?php echo $this->Html->link(__d('users', 'Change your password'), array('action' => 'change_password')); ?>
			</p>
		</fieldset>
	<?php echo $this->Form->end(__d('users', 'Submit')); ?>
</div>
<div class="mine">
<h2>Your Virtual Exhibits</h2>

<?php

//debug(count($pgc));
//debug($usergals);
foreach ($usergals as $usergal){
echo $this->Html->link($usergal['Usergal']['name'],array('action'=>'view',$usergal['Usergal']['id'])).' - ['.
$this->Html->link('Load',array('action'=>'mine','ed'=>$usergal['Usergal']['id'])).'] <br />';
}?>
</div>