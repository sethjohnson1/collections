<script>
	// To test the @id toggling on password inputs in browsers that don’t support changing an input’s @type dynamically (e.g. Firefox 3.6 or IE), uncomment this:
//	 $.fn.hide = function() { return this; }
	// Then uncomment the last rule in the <style> element (in the <head>).
	$(function() {
		// Invoke the plugin
		$('input').placeholder();
		// That’s it, really.
	});
</script>

<div class="treasure-search">
	<?php

		echo $this->Form->create('Treasure');
		echo $this->Html->link('Clear',array('action'=>'advancedsearch')).'<br />';
		//echo 'We are still working on the style for this page <br />';
		echo $this->Form->input('rdflag',array('type'=>'hidden','value'=>1));
	    echo $this->Form->input('accnum', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Accesion Number'));	 		
	    echo $this->Form->input('daterange', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Date','type'=>'text'));	 		
	    echo $this->Form->input('dimensions', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Dimensions','type'=>'text'));	 		
	    echo $this->Form->input('synopsis', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Synopsis','type'=>'text'));	 		
	    echo $this->Form->input('objtitle', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Object Title','type'=>'text'));	 		
	    echo $this->Form->input('creditline', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Credit Line','type'=>'text'));	 		
	    echo $this->Form->input('gloss', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Gloss','type'=>'text'));	 		
	    echo $this->Form->input('inscription', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Inscription','type'=>'text'));	 		
	    echo $this->Form->input('remarks', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Remarks','type'=>'text'));	 		
	    echo $this->Form->input('commonname', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Common Name','type'=>'text'));	 		
	    echo $this->Form->input('genus', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Genus speciies','type'=>'text'));	



		echo '<div class="the-boxs" id="boxs">';
		if(empty($this->params['named'])){
			echo $this->Form->checkbox('bbm',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Buffalo Bill Museum    ';
			echo $this->Form->checkbox('cfm',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Cody Firearms Museum ';
			echo $this->Form->checkbox('dmnh',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Draper Museum of Natural History <br>';
			echo $this->Form->checkbox('wg',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Whitney Gallery of Western Art';
			echo $this->Form->checkbox('pim',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Plains Indian Museum';
		}
		else{
			echo $this->Form->checkbox('bbm',array('div'=>false, 'class'=>'chkxbox')).'Buffalo Bill Museum    ';
			echo $this->Form->checkbox('cfm',array('div'=>false, 'class'=>'chkxbox')).'Cody Firearms Museum ';
			echo $this->Form->checkbox('dmnh',array('div'=>false, 'class'=>'chkxbox')).'Draper Museum of Natural History <br>';
			echo $this->Form->checkbox('wg',array('div'=>false, 'class'=>'chkxbox')).'Whitney Gallery of Western Art';
			echo $this->Form->checkbox('pim',array('div'=>false, 'class'=>'chkxbox')).'Plains Indian Museum';
		}

		echo $this->Form->checkbox('d',array('div'=>false, 'class'=>'chkxbox')).'Show only items on display<br />';
		echo '</div>';		


	    echo $this->Form->submit('Search', array('div' => true));	
		echo $this->Form->end();
		echo $this->Html->script('sj_autocp1');
		echo $this->Js->writeBuffer();
	?>
</div>