<div class="collections view">
<h2><?php echo __('Collection'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Oldid'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['oldid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($collection['Collection']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Collection'), array('action' => 'edit', $collection['Collection']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Collection'), array('action' => 'delete', $collection['Collection']['id']), null, __('Are you sure you want to delete # %s?', $collection['Collection']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Collections'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Treasures'); ?></h3>
	<?php if (!empty($collection['Treasure'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Oldid'); ?></th>
		<th><?php echo __('Accnum'); ?></th>
		<th><?php echo __('Daterange'); ?></th>
		<th><?php echo __('Dimensions'); ?></th>
		<th><?php echo __('Synopsis'); ?></th>
		<th><?php echo __('Objtitle'); ?></th>
		<th><?php echo __('Creditline'); ?></th>
		<th><?php echo __('Gloss'); ?></th>
		<th><?php echo __('Inscription'); ?></th>
		<th><?php echo __('Remarks'); ?></th>
		<th><?php echo __('Img'); ?></th>
		<th><?php echo __('Opencartid'); ?></th>
		<th><?php echo __('Collection Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($collection['Treasure'] as $treasure): ?>
		<tr>
			<td><?php echo $treasure['id']; ?></td>
			<td><?php echo $treasure['oldid']; ?></td>
			<td><?php echo $treasure['accnum']; ?></td>
			<td><?php echo $treasure['daterange']; ?></td>
			<td><?php echo $treasure['dimensions']; ?></td>
			<td><?php echo $treasure['synopsis']; ?></td>
			<td><?php echo $treasure['objtitle']; ?></td>
			<td><?php echo $treasure['creditline']; ?></td>
			<td><?php echo $treasure['gloss']; ?></td>
			<td><?php echo $treasure['inscription']; ?></td>
			<td><?php echo $treasure['remarks']; ?></td>
			<td><?php echo $treasure['img']; ?></td>
			<td><?php echo $treasure['opencartid']; ?></td>
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
