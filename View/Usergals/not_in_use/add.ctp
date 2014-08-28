<div class="usergals form">
<?php echo $this->Form->create('Usergal'); ?>
	<fieldset>
		<legend><?php echo __('Add Usergal'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('creator');
		echo $this->Form->input('email');
		echo $this->Form->input('editcode');
		echo $this->Form->input('publish');
		//echo $this->Form->input('Treasure');
		//debug($treasures);
		
		//this one works, but no JSON
		/*echo $this->Chosen->select(
		'Treasure.Treasure',
		$treasures,
		array('data-placeholder' => 'Type an Accession number . . .', 'multiple' => true));
		*/
		echo $this->Chosen->select(
		'Treasure.Treasure',
		array(),
		array('data-placeholder' => 'Type an Accession number . . .','multiple' => true));
		


	?>
	</fieldset>
<?php 
	echo $this->Form->end(__('Submit'));
	echo $this->Html->script('sj_autocp1');
	echo $this->Js->writeBuffer();

 ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Usergals'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Treasures'), array('controller' => 'treasures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Treasure'), array('controller' => 'treasures', 'action' => 'add')); ?> </li>
	</ul>
</div>
