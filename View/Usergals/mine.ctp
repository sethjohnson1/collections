<h2 style="padding:0px;margin:0px;">Your Virtual Exhibits</h2>

<div class="">
<?php
foreach ($usergals as $usergal){
echo $this->Html->link($usergal['Usergal']['name'],array('action'=>'view',$usergal['Usergal']['id'])).' - ['.
$this->Html->link('Load',array('action'=>'mine','ed'=>$usergal['Usergal']['id'])).'] <br />';
}

echo '<h3>Your Comments</h3>';
echo '<ul>';
foreach ($pgc as $comment){
	echo '<li>'.$comment['Comment']['body'].' ';
	if ($comment['Comment']['model']=='Usergal') echo $this->Html->link($childcnt[$comment['Comment']['id']].' Replies',array('action'=>'view',$comment['Comment']['foreign_key']));
	else echo $this->Html->link($childcnt[$comment['Comment']['id']].' Replies',array('controller'=>'treasures','action'=>'view?id='.$comment['Comment']['foreign_key']));
	
	//echo $childcnt[$comment['Comment']['id']].' Replies</li>';
	echo '</li>';
}
echo '</ul>';

echo '<div>';
		 echo $this->Paginator->counter(array('format' => __('Showing {:current} records out of {:count}')));
		echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
echo '</div>';

?>
<p style="padding:0px;margin:0px;font-size:smaller">
<?php echo $this->Html->link(__d('users', 'Change your password'), array('plugin'=>'users','controller'=>'users','action' => 'change_password'));?>
</p>
<br /><br />
</div>



