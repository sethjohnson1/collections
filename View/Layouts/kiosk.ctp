<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<head>
	<?php echo $this->Html->charset(); 
	echo $this->Html->script('ZoomifyImageViewer');
	
	echo $this->Html->script('Assets/ViewResizable/sizeViewerToPage.js');
	echo $this->Html->script('jquery.min');
	echo $this->Html->script('placeholders.min');		//added to automagicly fix the placeholders in older versions of IE
	echo $this->Html->script('modernizr');				//addded to help with older versions of ie like 
	echo $this->Html->script('jquery-ui-1.10.3.custom.min');
	echo $this->Html->script('ajax-chosen.min');
    echo $this->Html->script('jquery.autocomplete.min');
    echo $this->Html->script('jquery.uix.multiselect.min');
	echo $this->Html->css('jquery.autocomplete');

	
	echo $this->Html->css('jquery.uix.multiselect');
	echo $this->Html->css('jquery-ui-1.10.3.custom.min');
	
	//my script uses jQuery, so it only works when loaded AFTER!
	echo $this->Html->script('sj_cookie1');	
	//this one too

	echo $this->Html->meta('icon');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	echo $this->Html->css('center_of_the_west');
?>

<?php 
	if(!empty($TheTitle))	
		echo '<title>'.$TheTitle.'</title>';
	else 
		echo '<title>Buffalo Bill Online Collections</title>';
		
	if(!empty($TheDescription))	
		echo '<meta name="description" content="'.$TheDescription.'">';
	else
		echo '<meta name="description" content="The Buffalo Bill Center of the West shares our online collections with these images to give you a glimpse of thousands of photographs and objects from our vast artifact collections">';

	
	if(!empty($FeaturedImage))	
		echo '<meta property="og:image" content="'.$FeaturedImage.'"/>';
	
?>
<script type="text/javascript">
var _gas = _gas || [];
_gas.push(['_setAccount', 'UA-46559601-1']); 
_gas.push(['_setDomainName', '..org']);
_gas.push(['_require', 'inpage_linkid','//www.google-analytics.com/plugins/ga/inpage_linkid.js']);
_gas.push(['_trackPageview']);
_gas.push(['_gasTrackForms']);
_gas.push(['_gasTrackOutboundLinks']);
_gas.push(['_gasTrackMaxScroll']);
_gas.push(['_gasTrackDownloads']);
_gas.push(['_gasTrackVideo']); _gas.push(['_gasTrackAudio']);
_gas.push(['_gasTrackYoutube', {force: true}]);
_gas.push(['_gasTrackMailto']);

(function() {
var ga = document.createElement('script');
ga.id = 'gas-script';
ga.setAttribute('data-use-dcjs', 'true'); // CHANGE TO TRUE FOR DC.JS SUPPORT
ga.type = 'text/javascript';
ga.async = true;
ga.src = '//cdnjs.cloudflare.com/ajax/libs/gas/1.11.0/gas.min.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
})();
</script>
</head>
<body class="page" itemscope="itemscope" itemtype="http://schema.org/WebPage"><div class="site-container"><header class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader"><div class="wrap"><div class="title-area"><p class="site-title" itemprop="headline"><a href="#" title="Buffalo Bill Center of the West" >Buffalo Bill Center of the West</a></p></div><aside class="widget-area header-widget-area"></aside>

<nav class="nav-primary" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"><ul id="menu-top-menu" class="menu genesis-nav-menu menu-primary">

<li><?php echo $this->Html->link('New CFM Search', array('controller' => 'treasures','action' => 'cfmsg')); ?></li>
<li><a href="#" id="cfmsgmap">Study Galery Map</a></li>

</ul></nav></div></header>
<div class="site-inner"><div class="wrap"><div class="content-sidebar-wrap"><main class="content" role="main" itemprop="mainContentOfPage"><article class="post-10546 page type-page status-draft entry" itemscope="itemscope" itemtype="http://schema.org/CreativeWork"><header class="entry-header"><h1 class="entry-title" itemprop="headline"><?php echo $this->fetch('title'); ?></h1> 
</header><div class="entry-content" itemprop="text">
<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content'); ?>
</div></article></main></div></div></div>  

<div class="home-footer"><div class="wrap"><div class="home-footer-left widget-area"><section id="text-7" class="widget widget_text"><div class="widget-wrap"><h4 class="widget-title widgettitle">Hours</h4>
			<div class="textwidget"><div class="one-third first">
<p><span class="bold">March 1 - April 30</span><br>10 a.m.-5 p.m.</p>
<p><span class="bold">May 1 - September 15</span><br>8 a.m.-6 p.m.</p>
<p><span class="bold">September 15 - October 31</span><br>8 a.m.-5 p.m.</p></div>

<div class="two-thirds">
<p><span class="bold">November 1 - November 30</span><br>10 a.m.-5 p.m.</p>
<p><span class="bold">December 1 - February 28</span><br>Thu-Sun 10 a.m.-5 p.m.</p>
<p>Closed New Year's, Thanksgiving, &amp; Christmas days</p>
</div></div>
		</div></section>
</div><div class="home-footer-right widget-area"><section id="text-8" class="widget widget_text"><div class="widget-wrap"><h4 class="widget-title widgettitle">Rates</h4>
			<div class="textwidget"><div class="one-third first"><p class="bold">Members Free</p><p><span class="bold">Adult</span> $18</p><p><span class="bold">Seniors </span>$16<br>age 65 &amp; older</p></div>
<div class="one-third"><p><span class="bold">Students</span> $14<br>age 18 &amp; older<br>with valid student ID</p><p><span class="bold">Youth</span> $10<br>ages 6-17</p></div>
<div class="one-third"><p><span class="bold">Group tour rates</span><br>call 307-578-4114</p><p><span class="bold">Children Free</span><br>age 5 &amp; younger</p></div></div>
		</div></section>
</div></div></div>
<footer class="site-footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter"><div class="wrap"><p><span class="creds">&copy;&nbsp; Buffalo Bill Center of the West. All rights reserved.</span>
 	<span class="smithsonian">Smithonian Affiliations</span>
 	<span class="aam"><abbr title="The American Alliance of Museums">AAM</abbr></span></p></div></footer>    
  </div></body>