<div class="treasuresMedvalues form">
<?php echo $this->Form->create('TreasuresMedvalue'); ?>
	<fieldset>
		<legend><?php echo __('Edit Treasures Medvalue'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('treasure_id');
		echo $this->Form->input('medvalue_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TreasuresMedvalue.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TreasuresMedvalue.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Treasures Medvalues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Medvalues'), array('controller' => 'medvalues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Medvalue'), array('controller' => 'medvalues', 'action' => 'add')); ?> </li>
	</ul>
</div>
