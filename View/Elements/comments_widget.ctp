<?
//echo $this->Session->flash('commentFlash');
foreach ($comments['comments'] as $comment): ?>
<div class="row thread-container" style="">
<?
	$this->set('comment',$comment);
?>
	<div class="col-xs-12">
<?
	echo $this->element('comments_single_comment',array($comment));
	?>
	</div>
	
	<?
	if (!empty($comment['children'])):
		foreach ($comment['children'] as $kchild=>$child):?>
		<div class="col-xs-11 col-sm-offset-1 well">
		<?
			$this->set('comment',$child);
			echo $this->element('comments_single_comment',array($comment));
		?>
		<?if (!empty($child['children'])):
			foreach ($child['children'] as $klast=>$last):?>
			<div class="row">
			<div class="last_child col-xs-10 col-sm-offset-2">
			<?
			$this->set('comment',$last);
			echo $this->element('comments_single_comment',array($comment));?>
			</div>
			</div>
		<?		endforeach;
			endif;
			?>
		</div>
		<?
		endforeach;
	endif;
 ?>
</div>
<? endforeach;?>