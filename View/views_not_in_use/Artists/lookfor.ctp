<?php foreach ($art1 as $artist):
 echo $this->Html->link(__($artist['Artist']['name']), array('action' => 'view', $artist['Artist']['id']));
echo '<br />';
endforeach; ?>


