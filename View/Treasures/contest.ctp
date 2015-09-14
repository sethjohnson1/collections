<?=$this->Html->script('jquery.countdown.min.js')?>
<div class="row">
<div class="col-xs-12">

<h2>We're having a contest, and time is running out!</h2>


<style scoped>
p{
	text-align:justify;
}
</style>
<?//=$this->Html->image('animation.gif',array('alt'=>'The iconic beaded trucker hat','title'=>'Seth\'s favorite: The [famous] Beaded Trucker Hat','style'=>'float:right','class'=>'img-responsive'))?>
<div class="row">
<div class="col-sm-8">
<p>To celebrate our Online Collection, we've launched a contest! Have some fun exploring our the collection, and then create a <?=$this->Html->link('Virtual Exhibit',array('controller'=>'treasures','action'=>'pack'))?> of the 25 objects you would save if the Center faced imminent destruction. <a href="http://centerofthewest.org/2015/09/04/win-stuff/">Click here for the full scenario</a> and to see an awesome rotating carousel of the prizes.</p>
<p>Explore, search, then create your own! <?=$this->Html->link('Here are the entries so far.',array('controller'=>'usergals','action'=>'index','?'=>array('contest'=>'1')))?></p>
<h2 style="color:<?=$color['red']?>"><span id="clock"></span></h2>
</div>
<div class="col-sm-4">
<a href="http://centerofthewest.org/wp-content/uploads/2015/09/Vgal_prizes.jpg" class="thumbnail"><?=$this->Html->image('http://centerofthewest.org/wp-content/uploads/2015/09/Vgal_prizes.jpg',array('alt'=>'Prizes for the contest winners','title'=>'Look at all those REAL prizes!','style'=>'','class'=>''))?>
</a>
</div>
</div>



<h2>Creating a Virtual Exhibit</h2>
<ul>
<li>Search for what you want in your exhibit. For the true guru, we have an <?=$this->Html->link('advanced search',array('action'=>'advancedsearch'))?>.</li>
<li>Hover over a thumbnail and click on the + sign that appears to add the object to our exhibit.</li>
<li>Or click a thumbnail to view the full record and then click "Add to Virtual Exhibit."</li>
<li>Click on <strong>My Exhibit</strong> to give it a title and description, and fill in the <strong>Final details</strong>.</li>
<li>Click <strong>Save exhibit</strong>.</li>
<li>Check your e-mail for a "Thanks for curating a Virtual Exhibit" message with an edit code to keep—in case you want to edit later!</li>
</ul>
<?=$this->Html->image('animation.gif',array('alt'=>'Here is Ye Olde Animated GIF','title'=>'Seth\'s favorite: The [famous] Beaded Trucker Hat','style'=>'display: inline','class'=>'img-responsive'))?>
<?=$this->Html->image('help.jpg',array('alt'=>'Individual items can also be added','title'=>'Individual items can also be added','style'=>'display: inline; padding: 0 0 0 20px','class'=>'img-responsive'))?>
</div>
</div>
<?
$feedback='Provide Feedback';
if (isset($this->request->query['error'])) $feedback='Error Reporting';
if (isset($this->request->query['mimg']) || isset($this->request->query['zimg'])) $feedback='Missing Image';

?>

<script>
  $('#clock').countdown('2015/12/4', function(event) {
    $(this).html(event.strftime('%D days %H:%M:%S remaining'));
  });
</script>
