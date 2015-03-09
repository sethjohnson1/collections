<style type="text/css" scoped>
 .top_logo{
	margin:6px 0px 0px 10px;
	padding: 0px;
	z-index: 100;
	position:relative;
	top: 14px;
	float:left;
	//border-bottom: 5px solid green;
}
</style>
<?
//need to get a unique ID here, just wait until think of best way to do it
?>
<div data-role="page" id="qrpage" data-theme="a">
	<div data-role="header" data-position="fixed" style="border-bottom:9px solid #aa9c8f;background-color:#fff;">
		<div class="ui-block-a">
		<div class="top_logo">
		<? 
		echo $this->Html->image('1-mobile-logo-copy.png',array(
			'url'=>'#',
			'height'=>'80',
			'alt'=>'Center of the West logo'
		));
		?>
		</div>
		</div>
		<div class="ui-block-b"></div>
		<div class="ui-block-c"></div>
		<div class="ui-block-d"></div>
		<div class="ui-block-e"></div>
	</div>
	<div role="main" class="ui-content">
	<?
	echo $this->Session->flash();
	?>