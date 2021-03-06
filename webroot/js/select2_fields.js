$(document).ready(function() {

//this is for the 'go to page' function so that it only works when changed (otherwise it submits each time and can result in 404)

 
 //this is for all the select2 boxes . . very easy
 function formatVgal(img){
	//return "<b>"+img.id+"</b>";
	return '<img width="60%" height="60%" src="http://collections.centerofthewest.org/zoomify/1/' + img.id + '/TileGroup0/0-0-0.jpg">'
	+"<br />"+img.text
	;
 }
 
 $("#UsergalImg").select2({
	//placeholder: "Select some tags",
	//allowClear: false,
	width: "150px",
	height: "800px",
	formatResult: formatVgal
 }); 

$("#TreasureO").select2({
        placeholder: "Search by Object ID",
        minimumInputLength: 3,
		width: "500px",
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: "http://collections.centerofthewest.org/treasures/index.json",
           // dataType: 'jsonp',
            data: function (term) {
                return {
                    q: term // search term
                };
            },
            results: function (data) { // parse the results into the format expected by Select2.
				//console.log(data.results);
				return {
					results: $.map(data.results, function(item) {
						return {
							text: item.Treasure.accnum,
							id: item.Treasure.slug
						}
					})
				}
            }
        }
    });
 
 });