<div class="treasuresMedvalues index">
	<h2><?php echo __('Treasures Medvalues'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('treasure_id'); ?></th>
			<th><?php echo $this->Paginator->sort('medvalue_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($treasuresMedvalues as $treasuresMedvalue): ?>
	<tr>
		<td><?php echo h($treasuresMedvalue['TreasuresMedvalue']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($treasuresMedvalue['Treasure']['id'], array('controller' => 'treasures', 'action' => 'view', $treasuresMedvalue['Treasure']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($treasuresMedvalue['Medvalue']['name'], array('controller' => 'medvalues', 'action' => 'view', $treasuresMedvalue['Medvalue']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $treasuresMedvalue['TreasuresMedvalue']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $treasuresMedvalue['TreasuresMedvalue']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $treasuresMedvalue['TreasuresMedvalue']['id']), null, __('Are you sure you want to delete # %s?', $treasuresMedvalue['TreasuresMedvalue']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Treasures Medvalue'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Medvalues'), array('controller' => 'medvalues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Medvalue'), array('controller' => 'medvalues', 'action' => 'add')); ?> </li>
	</ul>
</div>
