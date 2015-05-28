<div class="row">
<div class="col-xs-12 badge-orange">
<?
if (isset($user['username'])){
	$formattedname=explode('^',$user['username']);
	$formattedname[0]=str_replace('_',' ',$formattedname[0]);
}
else $formattedname[0]='A Guest';
?>
<h1><?=$formattedname[0]?>'s dashboard</h1>
<p style="margin-top:-25px"><small>
<?
if (isset($user['email']))
echo $this->Html->link(__d('users', 'Change password'), array('plugin'=>'users','controller'=>'users','action' => 'change_password'));
else echo 'Logged in with your '.$user['provider'].' account.';
?>

</small>

</p>
<?
if (count($usergals)<1):
?>
<p><em>There are no Virtual Exhibits associated with this account. <?=$this->Html->link('Click here to get started',array('action'=>'pack','controller'=>'treasures'),array('class'=>'myx')).'!'?></em></p>
<?else:?>
<h3>Virtual exhibits</h3>
<table class="table table-striped">
<thead>
<tr>
<th>Exhibit</th>
<th>Comments</th>
</tr>
</thead>
<tbody>
<?php
foreach ($usergals as $usergal):
if ($usergal['Usergal']['listed']==false) $hiddentxt=' <br /><small><em>This exhibit has been hidden by the admin</em></small>';
else $hiddentxt='';
?>
<tr><td>
<?
echo $this->Html->link($usergal['Usergal']['name'],array('action'=>'view',$usergal['Usergal']['id'])).' - '.
$this->Html->link('<span style="font-size:.75em" class="glyphicon glyphicon-pencil"></span>',array('action'=>'mine','ed'=>$usergal['Usergal']['id']),array('escape'=>false,'title'=>'Edit this exhibit')).' '.$hiddentxt;
?>
</td><td><span class="badge badge-hov"><?=$usergal['comment_count']?></span><td></tr>
<?
endforeach?>
</tbody>
</table>
<?endif?>
<?if (count($comments)<1):?>
<p><em>You haven't left any comments yet. Once you do, you can manage them from here.</em></p>
<?else:?>
<h3>Your comments</h3>
<table class="table table-striped">
<thead>
<tr>
<th>Comment</th>
<th>Replies</th>
<th>Ups</th>
<th>Downs</th>

</tr>
</thead>
<tbody>
<?foreach ($comments as $comment):
if ($comment['Comment']['model']=='Treasure') $clink=' ['.$this->Html->link('visit',array('controller'=>'treasures','action'=>'view','?'=>array('id'=>$comment['Comment']['foreign_key']),'#'=>'comment_'.$comment['Comment']['id'])).']';
else if ($comment['Comment']['model']=='Usergal') $clink=' ['.$this->Html->link('visit',array('controller'=>'usergals','action'=>'view',$comment['Comment']['foreign_key'],'#'=>'comment_'.$comment['Comment']['id'])).']';
else $clink='';
?>
<tr>
<td><?=$this->Text->truncate($comment['Comment']['thoughts'],120).$clink?></td>
<td><span class="badge badge-hov"><?=$comment['reply_count']?></span></td>
<td><span style="background-color:<?=$color['green']?>; color: white" class="badge"><?=$comment['Comment']['upvotes'] ?></span></td>
<td><span style="background-color:<?=$color['red']?>; color: white" class="badge"><?=$comment['Comment']['downvotes'] ?></span></td>

</tr>
<?endforeach?>
</tbody>
</table>
<?endif?>
<h3>Badges and awards</h3>
<p><em>Earn badges and awards as you comment, reply, and create virtual galleries.</em></p>
</div>
</div>


