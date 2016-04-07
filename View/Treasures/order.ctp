<div class="row">
<div class="col-xs-12">
<h2>Order Museum-quality Prints</h2>
<style scoped>
p{
	text-align:justify;
}
</style>
<p>There's nothing better than a museum-quality print straight from the source. We print everything in-house and all proceeds go directly to the Buffalo Bill Center of the West. Due to the volume of our collection, we process each order individually. Simply submit this form and we will contact you to complete the order and take payment.</p>

<h2>Options and Pricing</h2>
<table class="table table-hover"> <thead> <tr> <th>Image Size</th> <th>Paper Size</th> <th>Glossy, Matte, or Semi-matte</th> <th>Fine Art Canvas</th> </tr> </thead> <tbody>
<tr> <td>5" x 7"</td> <td>8.5" x 11"</td> <td>$15.00</td> <td>$20.00</td> </tr>
<tr> <td>8" x 10"</td> <td>8.5" x 11"</td> <td>$20.00</td> <td>$30.00</td> </tr>
<tr> <td>11" x 14"</td> <td>13" x 19"</td> <td>$40.00</td> <td>$60.00</td> </tr>
<tr> <td>12" x 18"</td> <td>13" x 19"</td> <td>$45.00</td> <td>$70.00</td> </tr>
</tbody> </table>
<table class="table table-hover"> <thead> <tr> <th>Image Size</th> <th>Paper Size</th> <th>Fine Art Satin or Matte &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th> <th>Fine Art Canvas</th> </tr> </thead> <tbody>
<tr> <td>16" x 20"</td> <td>17" x 22"</td> <td>$55.00</td> <td>$85.00</td> </tr>
<tr> <td>18" x 22"</td> <td>20" x 24"</td> <td>$75.00</td> <td>$110.00</td> </tr>
<tr> <td>22" x 28"</td> <td>24" x 30"</td> <td>$110.00</td> <td>$165.00</td> </tr>
<tr> <td>30" x 40"</td> <td>32" x 44"</td> <td>$220.00</td> <td>$330.00</td> </tr>
<tr> <td>40" x 50"</td> <td>44" x 52"</td> <td>$350.00</td> <td>$525.00</td> </tr>
</tbody> </table>
<p><strong> Flat rate shipping is $15</strong> regardless of the number of prints you order, so order multiples to save on shipping!</p>
<h2>Your Information</h2>

<? 
//maybe need some Anti-Spam thing here eventually
echo $this->Form->create('Order',array());
			echo $this->Form->input('name',array(
				'type'=>'text','required'=>'required','placeholder'=>'Name (required)',
				'label'=>false,'legend'=>false,'class'=>'form-control'
			)).'<br />';
			echo $this->Form->input('email',array(
				'type'=>'email','required'=>'required','placeholder'=>'E-mail (required)',
				'label'=>false,'class'=>'form-control'
			)).'<br />';
			echo $this->Form->input('phone',array('type'=>'phone',
				'placeholder'=>'Phone (required)','required'=>'required',
				'label'=>false,'class'=>'form-control'
			)).'<br /><p>Accession number(s) you\'re interested in*:</p>';	
			echo $this->Form->input('accnum',array(
				'type'=>'textarea','placeholder'=>'Accession number(s)',
				'label'=>false,'class'=>'form-control'

			)).'<br /><p>*Not sure what to put here? Don\'t worry, just submit the form anyway and we\'ll contact you to help.</p>';				
			echo $this->Form->input('Submit',array(
				'type'=>'submit','id'=>'code_button',
				'class'=>'form-control','label'=>false
			
			));
?>


	<? 
	echo $this->Form->end()?>
	
	</div>
	</div>
