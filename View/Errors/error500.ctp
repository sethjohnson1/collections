<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<div class="row">
<div class="col-xs-12">
<div class="jumbotron" style="background-color:white">
<div class="row">
<div class="col-xs-5">
<img src="http://collectionimages.s3-website-us-west-1.amazonaws.com/1/112.67.jpg" alt="The End of the Trail" class="img-responsive" style="">
<p style="font-size:.75em"><?=$this->Html->link('End of the Trail',array('controller'=>'treasures','plugin'=>'','action'=>'view','end_of_the_trail')).' - 112.67'?></p>
</div>
<div class="col-xs-7">
<h1>Uh-oh. <small>
<?php echo $name; ?></small></h1>

	<p>
	<?php printf(
		__d('cake', 'An Internal Error Has Occurred.'),
		"<strong>'{$url}'</strong>"
	); ?><br /><br />
	If you keep receiving this message, please leave feedback at the bottom of <?=$this->Html->link('this page',array('controller'=>'treasures','action'=>'about','plugin'=>'','#'=>'feedback','?'=>array('src'=>$url,'error'=>$name)))?>.<br/><small>Just follow the link and send information on this, or on anything else regarding our Online Collections.</small>
	</p>
</div>
</div>
</div>
</div>
</div>
