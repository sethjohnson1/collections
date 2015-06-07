<div class="row">
<div class="col-xs-12">
<h2>Online Collections of the Buffalo Bill Center of the West</h2>
<style scoped>
p{
	text-align:justify;
}
</style>
<p>Welcome to our Online Collections! The Center's museums care for thousands of objects—from the common-place to the extraordinary.</p>
<?=$this->Html->image('trucker-hat.png',array('alt'=>'The iconic beaded trucker hat','title'=>'Seth\'s favorite: The [famous] Beaded Trucker Hat','style'=>'float:right','class'=>'img-responsive'))?>
<p>In Online Collections, you'll find objects from each museum, many on display but some currently in storage. For some we have a lot of information, for others we don't. Do you know something about an object that we don't, or have a story to share? Please comment or ask questions!</p>

<p>Explore, search, even create your own <?=$this->Html->link('Virtual Exhibit',array('controller'=>'treasures','action'=>'pack'))?>, and view <?=$this->Html->link('those made by others',array('controller'=>'usergals','action'=>'index'))?>.</p>

<h2>Searching the Collection</h2>
<ul>
<li>Click on <?=$this->Html->link('New Search',array('controller'=>'treasures','action'=>'index'))?></li>
<li>Use the <strong>Search the Collection</strong> box for keywords</li>
<li>Search all museums or narrow your search with the museum checkboxes.</li>
<li>You can search for what's <strong>On Display</strong> too.</li>
<li>Use <?=$this->Html->link('Advanced Search',array('controller'=>'treasures','action'=>'advancedsearch'))?> for more control.</li>
<li>Use <?=$this->Html->link('Site Search',array('controller'=>'treasures','action'=>'google_search_page'))?> to search our Online Collections site using Google.</li>
</ul>

<h2>Creating a Virtual Exhibit</h2>
<ul>
<li>Search for what you want in your exhibit.</li>
<li>Hover over a thumbnail and click on the + sign that appears to add the object to our exhibit.</li>
<li>Or click a thumbnail to view the full record and then click "Add to Virtual Exhibit."</li>
<li>Click on <strong>My Exhibit</strong> to give it a title and description, and fill in the <strong>Final details</strong>.</li>
<li>Click <strong>Save exhibit</strong>.</li>
<li>Check your e-mail for a "Thanks for curating a Virtual Exhibit" message with an edit code to keep—in case you want to edit later!</li>
</ul>
</div>
</div>
<?
$feedback='Provide Feedback';
if (isset($this->request->query['error'])) $feedback='Error Reporting';
if (isset($this->request->query['mimg']) || isset($this->request->query['zimg'])) $feedback='Missing Image';

?>
<a name="feedback"></a>
		<div class="row">
		<div class="col-xs-12">
			<h2><?=$feedback?></h2>
			<p>You can use this form to send feedback regarding this application or anything about your visit to the Buffalo Bill Center of the West. We'd
			love to hear from you!</p>
			<br />
<? 
//maybe need some Anti-Spam thing here eventually
echo $this->Form->create('Feedback',array());
			echo $this->Form->input('email',array(
				'type'=>'email','required'=>'required','placeholder'=>'Your e-mail',
				'label'=>false,'class'=>'form-control'
			)).'<br />';	
			echo $this->Form->input('message',array(
				'type'=>'textarea','placeholder'=>'Your message','required'=>'required',
				'label'=>false,'class'=>'form-control'

			)).'<br />';				
			echo $this->Form->input('Submit',array(
				'type'=>'submit','id'=>'code_button',
				'class'=>'form-control','label'=>false
			
			));
?>


	<? 
	echo $this->Form->end()?>
	
	</div>
	</div>
