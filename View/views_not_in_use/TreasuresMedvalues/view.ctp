<div class="treasuresMedvalues view">
<h2><?php echo __('Treasures Medvalue'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($treasuresMedvalue['TreasuresMedvalue']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Treasure'); ?></dt>
		<dd>
			<?php echo $this->Html->link($treasuresMedvalue['Treasure']['id'], array('controller' => 'treasures', 'action' => 'view', $treasuresMedvalue['Treasure']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Medvalue'); ?></dt>
		<dd>
			<?php echo $this->Html->link($treasuresMedvalue['Medvalue']['name'], array('controller' => 'medvalues', 'action' => 'view', $treasuresMedvalue['Medvalue']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Treasures Medvalue'), array('action' => 'edit', $treasuresMedvalue['TreasuresMedvalue']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Treasures Medvalue'), array('action' => 'delete', $treasuresMedvalue['TreasuresMedvalue']['id']), null, __('Are you sure you want to delete # %s?', $treasuresMedvalue['TreasuresMedvalue']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures Medvalues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasures Medvalue'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Medvalues'), array('controller' => 'medvalues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Medvalue'), array('controller' => 'medvalues', 'action' => 'add')); ?> </li>
	</ul>
</div>
