<div class="treasures form">
<?php echo $this->Form->create('Treasure'); ?>
	<fieldset>
		<legend><?php echo __('GoSomewhere'); ?></legend>
	<?php
	
	echo $this->Chosen->select(
    'Treasure.gosomewhere',
   $tr2,
    array('data-placeholder' => 'Object ID. . .', 'deselect' => true)
);

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

