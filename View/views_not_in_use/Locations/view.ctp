<div class="locations view">
<h2><?php echo __('Location'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($location['Location']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($location['Location']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Location'), array('action' => 'edit', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Location'), array('action' => 'delete', $location['Location']['id']), null, __('Are you sure you want to delete # %s?', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Treasures'); ?></h3>
	<?php if (!empty($location['Treasure'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Accnum'); ?></th>
		<th><?php echo __('Daterange'); ?></th>
		<th><?php echo __('Dimensions'); ?></th>
		<th><?php echo __('Synopsis'); ?></th>
		<th><?php echo __('Objtitle'); ?></th>
		<th><?php echo __('Creditline'); ?></th>
		<th><?php echo __('Gloss'); ?></th>
		<th><?php echo __('Inscription'); ?></th>
		<th><?php echo __('Collection Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($location['Treasure'] as $treasure): ?>
		<tr>
			<td><?php echo $treasure['id']; ?></td>
			<td><?php echo $treasure['accnum']; ?></td>
			<td><?php echo $treasure['daterange']; ?></td>
			<td><?php echo $treasure['dimensions']; ?></td>
			<td><?php echo $treasure['synopsis']; ?></td>
			<td><?php echo $treasure['objtitle']; ?></td>
			<td><?php echo $treasure['creditline']; ?></td>
			<td><?php echo $treasure['gloss']; ?></td>
			<td><?php echo $treasure['inscription']; ?></td>
			<td><?php echo $treasure['collection_id']; ?></td>
			<td><?php echo $treasure['location_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'treasures', 'action' => 'view', $treasure['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'treasures', 'action' => 'edit', $treasure['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'treasures', 'action' => 'delete', $treasure['id']), null, __('Are you sure you want to delete # %s?', $treasure['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
