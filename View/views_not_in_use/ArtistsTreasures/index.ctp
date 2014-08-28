<div class="artistsTreasures index">
	<h2><?php echo __('Artists Treasures'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('artist_id'); ?></th>
			<th><?php echo $this->Paginator->sort('treasure_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($artistsTreasures as $artistsTreasure): ?>
	<tr>
		<td><?php echo h($artistsTreasure['ArtistsTreasure']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($artistsTreasure['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $artistsTreasure['Artist']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($artistsTreasure['Treasure']['id'], array('controller' => 'treasures', 'action' => 'view', $artistsTreasure['Treasure']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $artistsTreasure['ArtistsTreasure']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $artistsTreasure['ArtistsTreasure']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $artistsTreasure['ArtistsTreasure']['id']), null, __('Are you sure you want to delete # %s?', $artistsTreasure['ArtistsTreasure']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Artists Treasure'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Artists'), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artist'), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
	</ul>
</div>
