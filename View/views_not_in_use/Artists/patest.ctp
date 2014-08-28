<?php
debug($this->passedArgs); 
?>
<div class="artists form">
<?php


echo $this->Form->create('Artist'); ?>
	<fieldset>
		<legend><?php echo __('Add Artist'); ?></legend>
	<?php
		//echo $this->Form->input('name');
		
		echo $this->Form->input('slug');
		echo $this->Form->input('madeup');
echo $this->Chosen->select(
    'Artist.chosen_multi',
    array(1 => 'Category 1', 2 => 'Category 2'),
    array('data-placeholder' => 'Pick categories...', 'multiple' => true)
);
?>
	</fieldset>
     <?php   echo $this->Form->submit(__('Search', true), array('div' => false));
        echo $this->Form->end();
	  // echo $this->Form->end(__('Submit'));
		?>
</div>

