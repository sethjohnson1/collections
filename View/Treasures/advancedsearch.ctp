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
		echo $this->Form->input('synopsis', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Synopsis','type'=>'text'));	 		
		echo $this->Form->input('remarks', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Remarks','type'=>'text'));	 				
		echo $this->Form->input('creditline', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Credit Line','type'=>'text'));	 		
		echo $this->Form->input('commonname', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Common Name','type'=>'text'));	 		
		echo $this->Form->input('genus', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Genus species','type'=>'text'));	
		echo $this->Form->input('taxonomic', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Taxonomic','type'=>'text'));			
		echo $this->Form->input('dimensions', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Dimensions','type'=>'text'));	 		
		echo $this->Form->input('daterange', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Date','type'=>'text'));
		echo $this->Form->input('objtitle', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Object Title','type'=>'text'));	 		
		echo $this->Form->input('gloss', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Gloss','type'=>'text'));	 		
		echo $this->Form->input('inscription', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Inscription','type'=>'text'));	 		
		echo $this->Form->input('accnum', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Accession Number'));	 		
		echo '<div class="the-boxs" id="boxs">';
		if(empty($this->params['named'])){
			echo $this->Form->checkbox('bbm',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Buffalo Bill Museum    ';
			echo $this->Form->checkbox('cfm',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Cody Firearms Museum ';
			echo $this->Form->checkbox('dmnh',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Draper Natural History Museum<br>';
			echo $this->Form->checkbox('wg',array('div'=>false, 'class'=>'chkxbox','checked'=>1)).'Whitney Western Art Museum';
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

<h2>Some tips for using "Advanced Search"</h2>
	<p>Here's how advanced search can be manipulated:</p>
	<ul>
	<li>Terms separated by space queries using AND operator. <a href="http://oc.bbhclan.org/treasures/advancedsearch/accnum:/daterange:/dimensions:/synopsis:silver%20necklace/objtitle:/creditline:/gloss:/inscription:/remarks:/commonname:/genus:/bbm:1/cfm:1/dmnh:1/wg:1/pim:1/d:0">Example, silver necklace finds everything with "silver" AND "necklace"</a></li>
	<li>Precede items with a MINUS SIGN to omit them. Example, <a href="http://oc.bbhclan.org/treasures/advancedsearch/accnum:/daterange:/dimensions:/synopsis:silver%20-necklace/objtitle:/creditline:/gloss:/inscription:/remarks:/commonname:/genus:/bbm:1/cfm:1/dmnh:1/wg:1/pim:1/d:0">everything silver without the term necklace</a></li>
	<li>Terms in quotes will be searched as a single entity. <a href="http://oc.bbhclan.org/treasures/advancedsearch/accnum:/daterange:/dimensions:/synopsis:blossom%20necklace/objtitle:/creditline:/gloss:/inscription:/remarks:/commonname:/genus:/bbm:1/cfm:1/dmnh:1/wg:1/pim:1/d:0">Example everything with "blossom necklace" in synopsis</a></li>
	<li>Omit quoted terms by placing MINUS INSIDE the quote <a href="http://oc.bbhclan.org/treasures/advancedsearch/accnum:/daterange:/dimensions:/synopsis:gun%20%22-buffalo%20bill%22/objtitle:/creditline:/gloss:/inscription:/remarks:/commonname:/genus:/bbm:1/cfm:1/dmnh:1/wg:1/pim:1/d:0/rdflag:1">What are guns without Buffalo Bill?</a></li>
	<li>Use the PERCENT SIGN as a wilcard - but know - at this point you are bypassing lots of magic. Try searching deer%, %deer%, " %deer% ", and "% deer %" 
	for four different sets of results.</li>
	<li>Combine results on different fields to hone your results. <a href="http://oc.bbhclan.org/treasures/advancedsearch/accnum:/daterange:/dimensions:/synopsis:red%20white%20blue%20-horse/objtitle:/creditline:Paul%20Dyck/gloss:/inscription:/remarks:%22dark%20blue%22/commonname:/genus:/bbm:1/cfm:1/dmnh:1/wg:1/pim:1/d:0/rdflag:1">For example...</a></li>
	<li>You can use the search on the results page to search through Advanced Search results. To refine your advanced search, simply return to this page</li>
	
	
	</ul>
<ul>
<li>In many if not most cases, searching the Synopsis field is your best bet.</li>
<li>Separate two or more keyword terms with space AND space. Example: silver necklace in Synopsis finds everything with "silver" AND "necklace"</li>
<li>Precede items with a MINUS SIGN to exclude them. Example: silver –necklace finds silver objects that are not necklaces</li>
<li>Put terms in quotes to search for them as a single entity. Example: "blossom necklace" is a more specific search than blossom necklace</li>
<li>Omit quoted terms by placing a MINUS SIGN INSIDE the quote. Example: use gun "-buffalo bill" to exclude the phrase "Buffalo Bill" from your search of guns</li>
<li>You can use the PERCENT SIGN as a wildcard—but know that at this point you are bypassing a lot of magic! Example: Try searching deer%, %deer%, " %deer% ", and "% deer %" for four different sets of results.</li>
<li>Combine results on different fields to hone your results. </li>
<li>For example: You can use the search function on your results page to search within the results of your Advanced Search. For example: your search for blossom necklace yields 9 results; if you now search for turquoise within those results, it narrows it down to 7 results</li>
<li>To continue refining your advanced search, simply return to this page.</li>
</ul>

Insider information

<h2>*Here are some fields you will rarely want to use in a search (and why):</h2>
<ul>
    <li>Date: In our records, there currently is not very consistent data here. It could be a date range, an exact date, or maybe a "circa" date like c. 1890, ca. 1890, or even 1890s. This makes it quite difficult to return good results.</li>
    <li>Accession Number: This is a museum’s unique identifier for an object, so searching it is only worthwhile IF you know the accession number exactly.</li>
    <li>Dimensions: There is little consistency to this data, but who you never know so try it if you like—you might get lucky.</li>
    <li>Object Title: fewer than 15 percent of our object records list a title, so don't be surprised by low results if you try it. Exceptions might include official titles of artwork.</li>
    <li>Gloss: Ditto above—this field in our records is for any additional information or narrative we have written about an object; unfortunately fewer than 5 percent of our records have gloss.</li>
    <li>Inscription: This field only has data if the object has, well, an inscription of some sort; and most do not.</li>
    <li>Remarks: Not a bad choice, because it includes descriptions or label text if a record has it, however, about a quarter of our records do not include remarks—so if you don’t get the results you expected, try Synopsis.</li>
</ul>
	
</div>