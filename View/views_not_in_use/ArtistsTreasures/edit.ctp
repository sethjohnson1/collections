<div class="artistsTreasures form">
<?php echo $this->Form->create('ArtistsTreasure'); ?>
	<fieldset>
		<legend><?php echo __('Edit Artists Treasure'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('artist_id');
		echo $this->Form->input('treasure_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ArtistsTreasure.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ArtistsTreasure.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Artists Treasures'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Artists'), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artist'), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
	</ul>
</div>
