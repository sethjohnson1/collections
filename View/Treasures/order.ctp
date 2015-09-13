<div class="row">
<div class="col-xs-12">
<h2>Order Museum-quality Prints</h2>
<style scoped>
p{
	text-align:justify;
}
</style>
<p>There's nothing better than a museum-quality print straight from the source. All proceeds go directly to the Buffalo Bill Center of the West. Due to the volume of our collection, we process each order individually. Simply submit this form and we will contact you to complete the order and take payment. Flat rate shipping is $15 - regardless of the number of prints you order.</p>

<h2>We need your Information</h2>

<? 
//maybe need some Anti-Spam thing here eventually
echo $this->Form->create('Order',array());
			echo $this->Form->input('email',array(
				'type'=>'email','required'=>'required','placeholder'=>'Your e-mail',
				'label'=>false,'class'=>'form-control'
			)).'<br />';
			echo $this->Form->input('phone',array(
				'placeholder'=>'Your phone (optional)',
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
