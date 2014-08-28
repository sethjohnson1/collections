<div class="artistsTreasures view">
<h2><?php echo __('Artists Treasure'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($artistsTreasure['ArtistsTreasure']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Artist'); ?></dt>
		<dd>
			<?php echo $this->Html->link($artistsTreasure['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $artistsTreasure['Artist']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Treasure'); ?></dt>
		<dd>
			<?php echo $this->Html->link($artistsTreasure['Treasure']['id'], array('controller' => 'treasures', 'action' => 'view', $artistsTreasure['Treasure']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Artists Treasure'), array('action' => 'edit', $artistsTreasure['ArtistsTreasure']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Artists Treasure'), array('action' => 'delete', $artistsTreasure['ArtistsTreasure']['id']), null, __('Are you sure you want to delete # %s?', $artistsTreasure['ArtistsTreasure']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Artists Treasures'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artists Treasure'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artists'), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artist'), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
	</ul>
</div>
