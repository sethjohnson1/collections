<?
// this is for the Session flash messages, I have modified UsersPlugin and Templates Controller to use it
//$type is for bootstrap selector
if (empty($type)) $type='success';
?>
<div id="sessionFlash" class="alert alert-dismissable fade in alert-<?=$type?>">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
<span class="glyphicon glyphicon-flag" aria-hidden="true"></span>
<style scoped>
/*div#sessionFlash {
	padding: 5px 10px;
	margin: 4px 1px;
}
*/
</style>
<?=$message?>
</div>