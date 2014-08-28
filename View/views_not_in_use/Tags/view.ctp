<div class="tags view">
<h2><?php echo __('Tag'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag Count'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['tag_count']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tag'), array('action' => 'edit', $tag['Tag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tag'), array('action' => 'delete', $tag['Tag']['id']), null, __('Are you sure you want to delete # %s?', $tag['Tag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Treasures'); ?></h3>
	<?php if (!empty($tag['Treasure'])): ?>
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
		<th><?php echo __('Slug'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tag['Treasure'] as $treasure): ?>
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
			<td><?php echo $treasure['slug']; ?></td>
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
