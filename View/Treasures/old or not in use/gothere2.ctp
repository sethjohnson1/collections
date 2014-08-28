<div class="treasures form">
<?php echo $this->Form->create('Treasure'); ?>
	<fieldset>
		<legend><?php echo __('GoSomewhere'); ?></legend>
	<?php
	
	echo $this->Chosen->select('Treasure.gosomewhere',array('data-placeholder' => 'Object Id . . . ','multiple'=>true));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>


<?php

echo $this->Html->scriptBlock(
    "
	$('#TreasureGosomewhere').ajaxChosen({
    type: 'GET',
    url: '/oc4/treasures/find.json',
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



<!-- script>
$("#TreasureGosomewhere").ajaxChosen({
    type: 'GET',
    url: '/oc4/treasures/find.json',
    dataType: 'json',
	jsonTermKey: 'q'
}, function (data) {
    var results = [];

    $.each(data, function (i, val) {
        results.push({ value: val.value, text: val.text });
    });

    return results;
});
</script -->