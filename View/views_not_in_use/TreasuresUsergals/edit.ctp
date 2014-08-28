<div class="treasuresUsergals form">
<?php echo $this->Form->create('TreasuresUsergal'); ?>
	<fieldset>
		<legend><?php echo __('Edit Treasures Usergal'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('treasure_id');
		echo $this->Form->input('usergal_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TreasuresUsergal.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TreasuresUsergal.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Treasures Usergals'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usergals'), array('controller' => 'usergals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergal'), array('controller' => 'usergals', 'action' => 'add')); ?> </li>
	</ul>
</div>
