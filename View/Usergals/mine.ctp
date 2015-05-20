<h2 style="padding:0px;margin:0px;">Your Virtual Exhibits</h2>

<div class="">
<?php
foreach ($usergals as $usergal){
echo $this->Html->link($usergal['Usergal']['name'],array('action'=>'view',$usergal['Usergal']['id'])).' - ['.
$this->Html->link('Load',array('action'=>'mine','ed'=>$usergal['Usergal']['id'])).'] <br />';
}

echo '<h3>Your Comments</h3>';?>

<em>Under construction</em>
<p style="padding:0px;margin:0px;font-size:smaller">
<?php echo $this->Html->link(__d('users', 'Change your password'), array('plugin'=>'users','controller'=>'users','action' => 'change_password'));?>
</p>
<br /><br />
</div>



