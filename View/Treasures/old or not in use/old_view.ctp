<div class="treasures view">
<h2><?php echo __('Treasure'); ?></h2>
<?php
if  (is_null($neighbors['prev']['Treasure']['slug']) == false){
 echo $this->Html->link(__('prev'), array('action' => 'view',$neighbors['prev']['Treasure']['slug'])); 
 }
 ?>
 |
 <?php
if  (is_null($neighbors['next']['Treasure']['slug']) == false){
 echo $this->Html->link(__('next'), array('action' => 'view',$neighbors['next']['Treasure']['slug'])); 
 }
 //debug($treasure);
?>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($treasure['Treasure']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accnum'); ?></dt>
		<dd>
			<?php echo h($treasure['Treasure']['accnum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Daterange'); ?></dt>
		<dd>
			<?php echo h($treasure['Treasure']['daterange']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimensions'); ?></dt>
		<dd>
			<?php echo h($treasure['Treasure']['dimensions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Synopsis'); ?></dt>
		<dd>
			<?php echo h($treasure['Treasure']['synopsis']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Objtitle'); ?></dt>
		<dd>
			<?php echo h($treasure['Treasure']['objtitle']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creditline'); ?></dt>
		<dd>
			<?php echo h($treasure['Treasure']['creditline']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gloss'); ?></dt>
		<dd>
			<?php echo h($treasure['Treasure']['gloss']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($treasure['Treasure']['img']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Collection'); ?></dt>
		<dd>
			<?php echo $this->Html->link($treasure['Collection']['name'], array('controller' => 'collections', 'action' => 'view', $treasure['Collection']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($treasure['Location']['name'], array('controller' => 'locations', 'action' => 'view', $treasure['Location']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Treasure'), array('action' => 'edit', $treasure['Treasure']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Treasure'), array('action' => 'delete', $treasure['Treasure']['id']), null, __('Are you sure you want to delete # %s?', $treasure['Treasure']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collections'), array('controller' => 'collections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection'), array('controller' => 'collections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artists'), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artist'), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Medvalues'), array('controller' => 'medvalues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Medvalue'), array('controller' => 'medvalues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usergals'), array('controller' => 'usergals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergal'), array('controller' => 'usergals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Images'); ?></h3>
	<?php if (!empty($treasure['Image'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Imgpath'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Sortorder'); ?></th>
		<th><?php echo __('Treasure Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($treasure['Image'] as $image): ?>
		<tr>
			<td><?php echo $image['id']; ?></td>
			<td><?php echo $image['imgpath']; ?></td>
			<td><?php echo $image['name']; ?></td>
			<td><?php echo $image['sortorder']; ?></td>
			<td><?php echo $image['treasure_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'images', 'action' => 'view', $image['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'images', 'action' => 'edit', $image['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'images', 'action' => 'delete', $image['id']), null, __('Are you sure you want to delete # %s?', $image['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Artists'); ?></h3>
	<?php if (!empty($treasure['Artist'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($treasure['Artist'] as $artist): ?>
		<tr>
			<td><?php echo $artist['id']; ?></td>
			<td><?php echo $artist['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'artists', 'action' => 'view', $artist['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'artists', 'action' => 'edit', $artist['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'artists', 'action' => 'delete', $artist['id']), null, __('Are you sure you want to delete # %s?', $artist['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Artist'), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Medvalues'); ?></h3>
	<?php if (!empty($treasure['Medvalue'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($treasure['Medvalue'] as $tag): ?>
		<tr>
			<td><?php echo $tag['id']; ?></td>
			<td><?php echo $tag['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tags', 'action' => 'view', $tag['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tags', 'action' => 'edit', $tag['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tags', 'action' => 'delete', $tag['id']), null, __('Are you sure you want to delete # %s?', $tag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Medvalue'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Tags'); ?></h3>
	<?php if (!empty($treasure['Tag'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($treasure['Tag'] as $tag): ?>
		<tr>
			<td><?php echo $tag['id']; ?></td>
			<td><?php echo $tag['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tags', 'action' => 'view', $tag['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tags', 'action' => 'edit', $tag['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tags', 'action' => 'delete', $tag['id']), null, __('Are you sure you want to delete # %s?', $tag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Medvalue'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Usergals'); ?></h3>
	<?php if (!empty($treasure['Usergal'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Creator'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($treasure['Usergal'] as $usergal): ?>
		<tr>
			<td><?php echo $usergal['id']; ?></td>
			<td><?php echo $usergal['name']; ?></td>
			<td><?php echo $usergal['creator']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'usergals', 'action' => 'view', $usergal['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'usergals', 'action' => 'edit', $usergal['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'usergals', 'action' => 'delete', $usergal['id']), null, __('Are you sure you want to delete # %s?', $usergal['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Usergal'), array('controller' => 'usergals', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
