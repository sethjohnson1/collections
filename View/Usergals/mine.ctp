<?
if (isset($user['username'])){
	$formattedname=explode('^',$user['username']);
	$formattedname[0]=str_replace('_',' ',$formattedname[0]);
}
else $formattedname[0]='A Guest';
?>
<h1><?=$formattedname[0]?>'s dashboard</h1>
<h3 class="badge-green" style="">Your Virtual Exhibits <span class="badge badge-hov"><?=count($usergals)?></span></h3>

<div class="badge-orange">
<?php
foreach ($usergals as $usergal):
$hiddentxt='';
if ($usergal['Usergal']['listed']==false) $hiddentxt=' (This exhibit has been hidden by the admin)<br />';
echo $this->Html->link($usergal['Usergal']['name'],array('action'=>'view',$usergal['Usergal']['id'])).' - ['.
$this->Html->link('Edit',array('action'=>'mine','ed'=>$usergal['Usergal']['id'])).'] '.$hiddentxt;
?>
Comments: <span class="badge badge-hov"><?='4'?></span>
<?
endforeach;

echo '<h3>Your Comments</h3>';?>

<em>Under construction</em>
<p style="padding:0px;margin:0px;font-size:smaller">

</p>
<h1><small>

<?
if (isset($user['email']))
echo $this->Html->link(__d('users', 'Change password'), array('plugin'=>'users','controller'=>'users','action' => 'change_password'));
else debug($user['Provider']);
?>

</small>


</h1>
</div>



