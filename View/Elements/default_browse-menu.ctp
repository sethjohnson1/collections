<?if (!isset($mobile)):?>
<li class="browse-item heading"><strong>Browse Museums</strong></li>
<?endif?>
<?//sj - fixed old, moronic way of doing this.. Sheesh...?>
			<?
			$glow='';
			if(!empty($this->params['named']['bbm'])==1) $glow=' glower';
			?>
            <li class="browse-item<?=$glow?>">
			<?
			$glow='';
			echo $this->Html->link(('&raquo; Buffalo Bill'),array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:1/wg:0/cfm:0/pim:0/dmnh:0/'),array('class'=>$glow,'escape'=>false)); ?>
            </li>
			<?
			$glow='';
			if(!empty($this->params['named']['wg'])==1) $glow=' glower';
			?>
            <li class="browse-item<?=$glow?>">
			<?
			echo $this->Html->link(('&raquo; Western Art'),array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:0/wg:1/cfm:0/pim:0/dmnh:0/'),array('escape'=>false)); ?>
            </li>
			<?
			$glow='';
			if(!empty($this->params['named']['cfm'])==1) $glow=' glower';
			?>
            <li class="browse-item<?=$glow?>">
			<?
			echo $this->Html->link(('&raquo; Firearms'),array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:0/wg:0/cfm:1/pim:0/dmnh:0/'),array('escape'=>false)); ?>
            </li>
			<?
			$glow='';
			if(!empty($this->params['named']['pim'])==1) $glow=' glower';
			?>
            <li class="browse-item<?=$glow?>">
			<?
			echo $this->Html->link(('&raquo; Plains Indian'),array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:1/dmnh:0/'),array('escape'=>false)); ?>
            </li>
			<?
			$glow='';
			if(!empty($this->params['named']['dmnh'])==1) $glow=' glower';
			?>
            <li class="browse-item<?=$glow?>">
			<?
			echo $this->Html->link(('&raquo; Natural History'),array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:0/dmnh:1/'),array('escape'=>false)); ?>
            </li>
            