<div class="usergals form">
<?php echo $this->Form->create('Usergal'); ?>
	<fieldset>
		<legend><?php echo __('Edit Usergal'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('creator');
		//echo $this->Form->input('Treasure');
		
				echo $this->Chosen->select(
		'Treasure.Treasure',
		array(),
		array('data-placeholder' => 'Type an Accession number . . .','multiple' => true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); 
	echo $this->Html->script('sj_autocp1');
	echo $this->Js->writeBuffer();
?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Usergal.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Usergal.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Usergals'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
	</ul>
</div>
