<div class="row">
<div class="col-xs-12">
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

<style>
.form-control{
display:inline;
}
</style>
	<?php

		echo $this->Form->create('Treasure');
		echo $this->Html->link('Clear',array('action'=>'advancedsearch')).'<br />';
		//echo 'We are still working on the style for this page <br />';
		echo $this->Form->input('rdflag',array('type'=>'hidden','value'=>1));
		echo $this->Form->input('synopsis', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Synopsis','type'=>'text','class'=>'form-control'));	 		
		echo $this->Form->input('remarks', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Remarks','type'=>'text','class'=>'form-control'));	 				
		echo $this->Form->input('creditline', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Credit Line','type'=>'text','class'=>'form-control'));	 		
		echo $this->Form->input('commonname', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Common Name','type'=>'text','class'=>'form-control'));	 		
		echo $this->Form->input('genus', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Genus species','type'=>'text','class'=>'form-control'));	
		echo $this->Form->input('taxonomic', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Taxonomic','type'=>'text','class'=>'form-control'));			
		echo $this->Form->input('dimensions', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Dimensions','type'=>'text','class'=>'form-control'));	 		
		echo $this->Form->input('daterange', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Date','type'=>'text','class'=>'form-control'));
		echo $this->Form->input('objtitle', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Object Title','type'=>'text','class'=>'form-control'));	 		
		echo $this->Form->input('gloss', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Gloss','type'=>'text','class'=>'form-control'));	 		
		echo $this->Form->input('inscription', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Inscription','type'=>'text','class'=>'form-control'));	 		
		echo $this->Form->input('accnum', array('div' => true,'empty'=>true,'label'=>'','placeholder'=>'Accession Number','class'=>'form-control'));	 		
?>
<div class="row checkbox-label">
<?
$boxoptions=array('div'=>false,'class'=>'regular-checkbox');
if(empty($this->params['named']['bbm'])) $boxoptions['checked']=1;
?>
<div class="col-sm-4 col-xs-6">
<?
echo $this->Form->checkbox('bbm',$boxoptions).' Buffalo Bill';
?>
</div>
<div class="col-sm-4 col-xs-6">
<?
echo $this->Form->checkbox('wg',$boxoptions).' Western Art';?>
</div>
<div class="col-sm-4 col-xs-6">
<?
echo $this->Form->checkbox('cfm',$boxoptions).' Firearms';
?>
</div>

<div class="col-sm-4 col-xs-6">
<?
echo $this->Form->checkbox('pim',$boxoptions).' Plains Indian';
?>
</div>
<div class="col-sm-4 col-xs-12">
<?
echo $this->Form->checkbox('dmnh',$boxoptions).' Natural History';
?>
</div>
<div class="col-sm-4 col-xs-12">
<?
echo $this->Form->checkbox('d',array('div'=>false,'class'=>'regular-checkbox')).' on display';
?>
</div>
     
</div>		

<?	


	    echo $this->Form->submit('Search', array('div' => true));	
		echo $this->Form->end();
		echo $this->Html->script('sj_autocp1');
		echo $this->Js->writeBuffer();
	?>
</div>
<div class="col-xs-12">
<h2>Advanced Search tips</h2>
<h3>
NOTE: <small>You can try Google Custom Search too:</small>
</h3>
<div class="row">
<div class="col-xs-8">
<?=$this->element('google_search')?>
</div>
</div>

<h4>Advanced searching:</h4>

<ul>
	<li>If you need to click <strong>back</strong> to return to this page, it should retain your entries.</li>
	<li>A space separating terms is treated as AND: <strong>silver necklace</strong> finds everything with “silver” AND “necklace”.</li>
	<li>A MINUS SIGN in front of a term omits it: <strong>silver -necklace</strong> find everything silver without the term necklace.</li>
	<li>Terms in quotes are searched as a phrase: <strong>“blossom necklace”</strong> in Synopsis finds records with that exact phrase in the synopsis.</li>
	<li>Putting a MINUS SIGN inside the quotes omits the term or phrase: <strong>gun “-buffalo bill”</strong> returns “gun” records without the term “buffalo bill” in them.</li>
	<li>Use the PERCENT SIGN as a wildcard&mdash;but with caution. Searching with <strong>deer%</strong>, <strong>%deer%</strong>, <strong>%deer%</strong>, and <strong>% deer %</strong> yields four different sets of results!</li>
	<li>Combine results on different fields for more specific results. Try this.</li>
	<li>After you do an Advanced Search and get the results, doing another search on that results page will search just that data set. If those results are not what you’re looking for, simply click <strong>back</strong> and refine your search. For example: your search for <strong>blossom necklace</strong> yields 9 results; if you now search for <strong>turquoise</strong> within those results, it narrows it down to 7 results.</li>
</ul>

<h4>Fields to use sparingly in a search (and why):</h4>

<ul>
	<li>Date: Our records don’t currently have standardized data in date fields. It could be a date range, an exact date, or maybe a "circa" date like c. 1890, ca. 1890, or even 1890s. So returning good results is difficult.</li>
	<li>Dimensions: This data is also not very standardized, but try it if you like&mdash;you might get lucky!</li>
	<li>Object Title: fewer than 15 percent of our object records list a title, so don't be surprised by few results if you try it. An exception is the exact title of an artwork.</li>
	<li>Gloss: This field is for any additional information or narrative our staff has written about an object; unfortunately fewer than 5 percent of our records have gloss.</li>
	<li>Inscription: This field only has data if the object has an inscription of some sort on it, and most do not.</li>
	<li>Remarks: This field includes descriptions or label text if a record has that information. About 75 percent of our records do so try it if you like; if you don’t get much for results, try Synopsis instead.</li>
</ul>
	
</div>
</div><!-- /row -->