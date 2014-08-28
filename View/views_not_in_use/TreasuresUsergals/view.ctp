<div class="treasuresUsergals view">
<h2><?php echo __('Treasures Usergal'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($treasuresUsergal['TreasuresUsergal']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Treasure'); ?></dt>
		<dd>
			<?php echo $this->Html->link($treasuresUsergal['Treasure']['id'], array('controller' => 'treasures', 'action' => 'view', $treasuresUsergal['Treasure']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usergal'); ?></dt>
		<dd>
			<?php echo $this->Html->link($treasuresUsergal['Usergal']['name'], array('controller' => 'usergals', 'action' => 'view', $treasuresUsergal['Usergal']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Treasures Usergal'), array('action' => 'edit', $treasuresUsergal['TreasuresUsergal']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Treasures Usergal'), array('action' => 'delete', $treasuresUsergal['TreasuresUsergal']['id']), null, __('Are you sure you want to delete # %s?', $treasuresUsergal['TreasuresUsergal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures Usergals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasures Usergal'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usergals'), array('controller' => 'usergals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usergal'), array('controller' => 'usergals', 'action' => 'add')); ?> </li>
	</ul>
</div>
