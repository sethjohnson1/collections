$('#TreasureO').ajaxChosen({
	type: 'GET',
	url: '/treasures/index.json',
	dataType: 'json',
	jsonTermKey: 'q',
	placeholder_text_single: 'pick stuff'
	},
	function (data) {

	var results = [];
	$.each(
	data, function (i, val) {
results.push(val.map(function(t){
    return { value: t.Treasure.slug, text: t.Treasure.accnum };
}))

});
		
		//console.log ( results);
		return results[0];
		//end function (data)
		}
		
		//end ajaxChosen
	);
$('#TreasureTreasure').ajaxChosen({
	type: 'GET',
	url: '/treasures/index.json',
	dataType: 'json',
	jsonTermKey: 'q',
	placeholder_text_single: 'pick stuff'
	},
	function (data) {

	var results = [];
	$.each(
	data, function (i, val) {
results.push(val.map(function(t){
    return { value: t.Treasure.id, text: t.Treasure.accnum };
}))

});
		
		//console.log ( results);
		return results[0];
		//end function (data)
		}
		
		//end ajaxChosen
		);
		
$('#UsergalImg').ajaxChosen({
	type: 'GET',
	url: '/treasures/index.json',
	dataType: 'json',
	jsonTermKey: 'q',
	placeholder_text_single: 'pick stuff'
	},
	function (data) {

	var results = [];
	$.each(
	data, function (i, val) {
results.push(val.map(function(t){
    return { value: t.Treasure.img, text: t.Treasure.accnum };
}))

});
		
		//console.log ( results);
		return results[0];
		//end function (data)
		}
		
		//end ajaxChosen
		);
		