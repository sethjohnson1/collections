		<li class="menu-item"><?php echo $this->Html->link(__('New Search'), array('plugin'=>'','controller' => 'treasures','action' => 'index')); ?> </li>
		<li class="menu-item"><?php echo $this->Html->link(__('Search Makers'), array('plugin'=>'','controller' => 'makers', 'action' => 'index')); ?> </li>
		<li class="menu-item"><?php echo $this->Html->link(__('Search Mediums'), array('plugin'=>'','controller' => 'medvalues', 'action' => 'index')); ?> </li>
		<li class="menu-item"><?php echo $this->Html->link(__('Virtual Exhibits'), array('plugin'=>'','controller' => 'usergals', 'action' => 'index')); ?></li>      				
<? if( $this->Session->read('Auth.User')) echo '<li class="menu-item badge-green">'.$this->Html->link('My Dashboard <span class="badge badge-hov">?!</span>',array('plugin'=>'','controller'=>'usergals','action'=>'mine'),array('escape'=>false)).'</li>';?>                        

		<li class="menu-item exhibit badge-orange"><?php 
		//$ct from the AppController
		echo $this->Html->link('My Exhibit<span id="excount"> <span class="ExNum badge badge-hov"></span></span>',array('plugin'=>'','controller' => 'treasures', 'action' => 'pack'),array('id'=>'myx','escape'=>false));?></li>
        		<?php	
		if(!$this->Session->read('Auth.User'))
			//echo '<li class="menu-item">'.$this->Html->link('Log In', array('plugin'=>'users','controller'=>'users','action'=>'login')).'</li>';
			echo '<li class="menu-item"><a href="#login-modal" class="" data-toggle="modal">Log In</a></li>';
		if( $this->Session->read('Auth.User'))
			{
				echo '<li class="menu-item">'.$this->Html->link('Log Out', array('plugin'=>'users','controller'=>'users','action'=>'logout'),null, __('Are you sure you want to log out? Unsaved changes to your Virtual exhibit will be lost.')).'</li>';

			}
		//else echo '</li><li class="menu-item">'.$this->Html->link('Register', array('plugin'=>'users','controller'=>'users','action'=>'add')).'</li>';
		?>
		<li class="menu-item"><?php echo $this->Html->link(__('About/Help'), array('plugin'=>'','controller' => 'treasures','action' => 'about')); ?> </li>