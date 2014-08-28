<div class="treasures index">
	<h2><?php echo __('Treasures'); ?></h2>
	
		<!--This div is for the search stuff! -->
	<div>
	<?php

echo $this->Form->create('Treasure');
//debug($treasures);
 //the field below is for the HABTM test
  //   echo $this->Form->input('makers', array('div' => true,'empty'=>true,'label'=>'stwo','type'=>'text'));

		//debug($this->params['named']);
	
		
		//echo $this->Form->input('makers', array('div' => true,'empty'=>true,'label'=>'makers'));
		
		//echo $this->Chosen->select('Treasure.makers',array('data-placeholder' => 'Object Id . . . ','multiple'=>false));
	    echo $this->Form->input('searchall', array('div' => true,'empty'=>true,'label'=>''));	 
		echo $this->Form->checkbox('bbm',array('div'=>false)).'bbm <br />';
		echo $this->Form->checkbox('cfm',array('div'=>false,)).'cfm <br />';
		echo $this->Form->checkbox('dmnh',array('div'=>false)).'dm <br />';
		echo $this->Form->checkbox('pim',array('div'=>false)).'pim <br />';
		echo $this->Form->checkbox('wg',array('div'=>false)).'wg <br />';
	    echo $this->Form->submit(__('Search', true), array('div' => true));	
        echo $this->Form->end();
		echo $this->Html->scriptBlock(
		"
			$('#TreasureMakers').ajaxChosen({
				type: 'GET',
				url: '/treasures/find.json',
				dataType: 'json',
				jsonTermKey: 'q',
				placeholder_text_single: 'pick stuff'
					}, function (data) {
						var results = [];
						$.each(data, function (i, val) {
							results.push({ value: val.value, text: val.text });
						});

				return results;
					});
	",
    array('inline' => true)
);

?>
	
	</div>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($treasures as $treasure): ?>
	<tr>
		<td><?php echo h($treasure['Treasure']['slug']); ?>&nbsp;</td>

		<td>
			<?php echo $this->Html->link($treasure['Collection']['name'], array('controller' => 'collections', 'action' => 'view', $treasure['Collection']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($treasure['Location']['name'], array('controller' => 'locations', 'action' => 'view', $treasure['Location']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $treasure['Treasure']['slug'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $treasure['Treasure']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $treasure['Treasure']['id']), null, __('Are you sure you want to delete # %s?', $treasure['Treasure']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Treasure'), array('action' => 'add')); ?></li>
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

 <script>
  $(document).ready(function(){  
    $("#TreasureSearchdata").autocomplete("/oc4/treasures/find", {
    minChars: 2,
	remoteDataType: 'json'
    });
  });
</script>
