<div class="collections form">
<?php echo $this->Form->create('Collection'); ?>
	<fieldset>
		<legend><?php echo __('Add Collection'); ?></legend>
	<?php
		echo $this->Form->input('oldid');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Collections'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
	</ul>
</div>
