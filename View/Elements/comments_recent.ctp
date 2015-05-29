<? // this needs to be an async call, so it talks back to recent method on CommentsUsers
if (!isset($qty)) $qty=5;
?>
<script>
$(document).ready(function() { 
  	$.ajax({
	async:true,
	dataType:"json",
	success:function (data, textStatus) {

	for (i=0; i< data['comments'].length; i++){
		console.log(data['comments'][i]);
	}
	/* just fix this up and put inside loop!
	var html='<div class="row"><div class="col-xs-4">';
	html+='<a href="'+data['link']+'"><img src="'+data['featured_image']['attachment_meta']['sizes']['thumbnail']['url']+'" class="img-responsive img-thumbnail alt=" " /></a>';
	html+='</div><div class="col-xs-8"><p style="text-align:justify;">';
	html+='<a href="'+data['link']+'" >'+data['title']+'</a><br />';
	html+='<span style="font-style: italic; font-size:90%"> By '+data['author']['name']+"</span><br />";
	html+=data['excerpt'];
	html+='</p><hr /></div></div><br />';
	
	$('.recent_comments').append(html);
	
	*/
	},
	url:"http://<?=$_SERVER['HTTP_HOST'].Router::url(array('controller'=>'commentsUsers','action'=>'recent',$qty.'.json'))?>"});
	return false;
});
</script>
<!-- start with row as this should be nested in a coulumn (or not -->
<div class="row">
<div class="col-xs-12 recent_comments">

</div>
</div>