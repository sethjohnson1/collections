<div class="treasuresUsergals index">
	<h2><?php echo __('Treasures Usergals'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('treasure_id'); ?></th>
			<th><?php echo $this->Paginator->sort('usergal_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($treasuresUsergals as $treasuresUsergal): ?>
	<tr>
		<td><?php echo h($treasuresUsergal['TreasuresUsergal']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($treasuresUsergal['Treasure']['id'], array('controller' => 'treasures', 'action' => 'view', $treasuresUsergal['Treasure']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($treasuresUsergal['Usergal']['name'], array('controller' => 'usergals', 'action' => 'view', $treasuresUsergal['Usergal']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $treasuresUsergal['TreasuresUsergal']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $treasuresUsergal['TreasuresUsergal']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $treasuresUsergal['TreasuresUsergal']['id']), null, __('Are you sure you want to delete # %s?', $treasuresUsergal['TreasuresUsergal']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Treasures Usergal'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usergals'), array('controller' => 'usergals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergal'), array('controller' => 'usergals', 'action' => 'add')); ?> </li>
	</ul>
</div>
