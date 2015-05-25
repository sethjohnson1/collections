$(function() {
	$("#myStuffSendForm").submit( function () {    
		var b1 = $("#bucket_1").sortable('serialize'); 
		var b2 = $("#bucket_2").sortable('serialize');
		var dataArray = new Array();
		//console.log($('#myStuffSendForm').serialize());
		//console.log($("#bucket_2").sortable('serialize'));
        $.ajax({   
			type: "POST",
			//the whole form
			data : $('#myStuffSendForm').serialize(),
			//just a variable
			//data : b2,
			cache: false, 
			url: "respond.json" , 
			success: function(data){
			//var json = $.parseJSON(data);
			//console.log(data.response.success);
				$('#resultField').append(data.response[1]);
				//console.log(data);
		   }
		   
		})
	});
	
	$( "#bucket_1" ).sortable({
		cursor: "move",
		connectWith: "#bucket_2",
		update: function(event, ui) {
			$.ajax({   
			type: "POST",
			data : $(this).serialize(),
			cache: false, 
			url: "respond.json" , 
			success: function(data){
			//var json = $.parseJSON(data);
			//console.log(data.response.success);
				$('#resultField').append(data.response.success);
				//console.log(data);
		   }
		   
		});
		//console.log($(this).serialize());
		}
		
	});
	$( "#bucket_2" ).sortable({
		connectWith: "#bucket_1",
		update: function(event, ui){

			$('input.results').val("text");

			var end_pos = $(ui.item).parents('div').attr('id');
			console.log(end_pos);
		}
	});
	$( "#all-buckets" ).sortable({
	//update: console.log("hey")
		//connectWith: "#bucket_1"
	});
  });