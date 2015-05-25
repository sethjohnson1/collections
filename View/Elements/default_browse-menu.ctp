<?if (!isset($mobile)):?>
<li class="browse-item heading"><strong>Browse Museums</strong></li>
<?endif?>
            <li class="browse-item" <?php if(!empty($this->params['controller'])=='treasures'){if(!empty($this->params['data']['Treasure']['bbm'])==1){echo 'id="glower" ';}}?>>
			<?php echo $this->Html->link(__('> Buffalo Bill'),array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:1/wg:0/cfm:0/pim:0/dmnh:0/')); ?> 
            </li>
            
            <li class="browse-item" <?php if(!empty($this->params['controller'])=='treasures'){if(!empty($this->params['data']['Treasure']['wg'])==1){echo 'id="glower" ';}}?>><?php echo $this->Html->link(__('> Western Art'), array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:0/wg:1/cfm:0/pim:0/dmnh:0/')); ?> </li>
            <li class="browse-item" <?php if(!empty($this->params['controller'])=='treasures'){if(!empty($this->params['data']['Treasure']['cfm'])==1){echo 'id="glower" ';}}?>><?php echo $this->Html->link(__('> Firearms'), array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:0/wg:0/cfm:1/pim:0/dmnh:0/')); ?> </li>
            <li class="browse-item" <?php if(!empty($this->params['controller'])=='treasures'){if(!empty($this->params['data']['Treasure']['pim'])==1){echo 'id="glower" ';}}?>><?php echo $this->Html->link(__('> Plains Indian'), array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:1/dmnh:0/')); ?> </li>
            <li class="browse-item" <?php if(!empty($this->params['controller'])=='treasures'){if(!empty($this->params['data']['Treasure']['dmnh'])==1){echo 'id="glower" ';}}?>><?php echo $this->Html->link(__('> Natural History'), array('plugin'=>'','controller' => 'treasures','action' => 'index'.'/bbm:0/wg:0/cfm:0/pim:0/dmnh:1/')); ?> </li>