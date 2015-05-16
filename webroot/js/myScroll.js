jQuery(document).ready( function($) {

	//this sets the direction and how much each slide should move
	$('#featured-gals').scrollbox({ direction: 'h',distance: 150});

	//this allows for the hover effect giving you info about each object when u hover over them, like in netflix
	$('li.slides').hover(
		function(){
			$(this).find('.bubble').toggle(0);			
		},
		function(){
			$(this).find('.bubble').toggle(0);
		}
	);
	$('li.slides').mousemove(
		function( event ) 
		{		
			$(this).find('.bubble').css('left',event.pageX);
			$(this).find('.bubble').css('top',event.pageY);
		}
	);
});