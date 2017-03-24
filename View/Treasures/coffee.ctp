<?
//debug($this->request->data);
?>
<div class="alert<?=$msg['class']?> alert-dismissable" role="alert" style="cursor: pointer" onclick="$(this).fadeOut();"><?=$msg['msg']?></div>

<script>
$(document).ready(function(){
$('.coffee-breaks').text('<?=$coffees?>').fadeIn();
});
</script>