<div class="treasures form">
<?php echo $this->Form->create('Treasure'); ?>
	<fieldset>
		<legend><?php echo __('Add Treasure'); ?></legend>
	<?php
		echo $this->Form->input('accnum');
		echo $this->Form->input('daterange');
		echo $this->Form->input('dimensions');
		echo $this->Form->input('synopsis');
		echo $this->Form->input('objtitle');
		echo $this->Form->input('creditline');
		echo $this->Form->input('gloss');
		echo $this->Form->input('inscription');
		echo $this->Form->input('collection_id');
		echo $this->Form->input('location_id');
		echo $this->Form->input('Artist');
		echo $this->Form->input('Medvalue');
		echo $this->Form->input('Usergal');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Treasures'), array('action' => 'index')); ?></li>
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
