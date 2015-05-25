
$(function() {
/*	$( ".basic-results" ).sortable({
cursor: "move",

	update: function(event, ui) {
		$('input.currentposition').each(function(idx) {
			//$(this).val(idx);
		});
		var start_pos = ui.item.data('start_pos');
		//var end_pos = $(ui.item).index();
		var end_pos = $(ui.item).index();
		var data = $(this).sortable('serialize');   
            // POST to server using $.post or $.ajax
           // alert(data);
			}

});
	
    $( ".search-results" ).sortable({
	
	//this stuff is all in the demo, but I am saving it for a bit longer
	//connectWith: ".column",
	//handle: ".portlet-header",
	//cancel: ".portlet-toggle",
	//placeholder: "portlet-placeholder ui-corner-all",
	cursor: "move",
//	containment: "parent",
	tolerance: "intersect",
	start: function(event, ui) {
		var start_pos = ui.item.index();
		ui.item.data('start_pos', start_pos);		
	},
	//rewrites the hidden form value every time the page is refreshed
	stop: function () {

	},
	update: function(event, ui) {
		$('input.currentposition').each(function(idx) {
			//$(this).val(idx);
		});
		var start_pos = ui.item.data('start_pos');
		//var end_pos = $(ui.item).index();
		var end_pos = $(ui.item).index();
		var data = $(this).sortable('serialize');   
            // POST to server using $.post or $.ajax
            alert(data);
		
		//this is a way to get the unique ID of the item - lots of ways to do it..
		var col_name = $(ui.item.context.childNodes[0].innerText);
		//var fullmont = $(ui.item.data());
		//sortableItem
		var fm = ui.item.data('sortableItem');
		var foo = ui.item.data('sortableItem').direction;
		//console.log(start_pos + ' - ' + end_pos);
		//console.log(col_name);
		//console.log(end_pos);
		//console.log(ui.item.context);
	}
    });
	*/
	$("#TreasurePackForm").submit( function () {    
		var data = $(".basic-results").sortable('serialize'); 
			console.log(data);
                        $.ajax({   
                            type: "POST",
                            data : data,
                            cache: false,  
                            url: "http://oc.bbhclan.org/treasures/respond.json" , 
                            success: function(data){
                            console.log(data);    }                
                              
                        })
						});
	
	
  });