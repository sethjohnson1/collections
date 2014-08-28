//this is the social link calls
(function(w, d, s) {
  function go(){
    var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.src = url; js.id = id;
	  fjs.parentNode.insertBefore(js, fjs);
	};
    load('//connect.facebook.net/en_US/all.js#appId=439647136153644&xfbml=1', 'fbjssdk');
    load('//apis.google.com/js/plusone.js', 'gplus1js');
    load('//platform.twitter.com/widgets.js', 'tweetjs');
  }
  if (w.addEventListener) { w.addEventListener("load", go, false); }
  else if (w.attachEvent) { w.attachEvent("onload",go); }
}(window, document, 'script'));
//end the social calls

$(document).ready(function() {

emptyvexhibit();
/*var maplightbox ="<div class='overlay'></div> <div class='lightbox'><p class='closebutton'><img src='http://collections.centerofthewest.org/img/close.png'></p> <p>Welcome to Our Website Here are some Instructions</p>  </div>";

$( 'a#cfmsgmap' ).click(function() 
{
	$('body').append(maplightbox);
});		*/


	
//this highlights all the txt in a textarea with the id of bitly, textarea must have id not the div its inside!!
	$("#bitly").on("focus keyup", function(e){
		var keycode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if(keycode === 9 || !keycode){
			var $this = $(this);
			$this.select();
			// fixes chrome's alternative select function
			$this.on("mouseup", function() {
				$this.off("mouseup");
				return false;
			});
		}
	});
//end highlight code
//is dirtyflag		
var isDirty = false
//is dirtyflag
//hover for image block on all pages 
$('.img-block').hover(
		function(){
			$(this).find('.caption').fadeIn(250);
			$(this).find('.caption-pack').fadeIn(250);
		},
		function(){
			$(this).find('.caption').fadeOut(100);
			$(this).find('.caption-pack').fadeOut(100);			
		}
	);	
//hover for image block on all pages

//search acecssion number toggle
	$("a.search-acc").click(function(){
		$('#oid-search').toggle(function () {			
				if($("a#tclass").text()=='Search by Accession Number')
					$("a#tclass").text("Search All");

				else if($("a#tclass").text()=='Search All')
					$("a#tclass").text("Search by Accession Number");
			});
		$('#srch').toggleClass('search-help search-help-t');
		$('#TreasureSearchall').toggle();
		$('.the-boxs').toggle();
		$('.submit').toggle();			
	
	 });
//search  acecssion number toggle

//seths a pointed when using no href A's
    $("a").css("cursor", "pointer");	
//seths a pointed when using no href A's	

//remove from pack
	$( ".gal a#gone" ).click(function() {	
		$(this).closest('.the-objects').remove()
	});
//end remove in the pack	
	
//Start + and - toggle	
	$( "a#add" ).click(function() {	
		$(this).toggleClass('xs invisible',0);		
		$(this).next().toggleClass('xs invisible',0);

	});
	$( "a#remove" ).click(function() {
		$(this).toggleClass('xs invisible',0);
		$(this).prev().toggleClass('xs invisible',0);
	});	
//End + and - toggle
	
//Start	Set Virutal Gallery # on Page Load
	if(getCookie("CakeCookie[vgal]")=="")
		{$("#ExNum").text('None');}
	else
		{$("#ExNum").fadeOut(500,function(){$(this).text(getCookie("CakeCookie[vgal]").split(" ").length).fadeIn(500);});}
//End	Set Virutal Gallery # on Page Load		
});
function emptyvexhibit(){
$( "a#myx" ).click(function() {
	var lightbox ="<div class='overlay' onclick=\"$('.overlay').remove();$('.lightbox').remove();\"></div> <div class='lightbox'><a href='#' class='closebutton' onclick=\"$('.overlay').remove();$('.lightbox').remove();\"><img src='http://collections.centerofthewest.org/img/close.png'></a><h2>Welcome to our Online Collections! Some basic instructions to get you started:</h2><ul>    <li>Enter a keyword in \"Search all Fields\" or try an \"Advanced Search\"</li>    <li>Select your favorite objects by clicking on the + symbol of a thumbnail or on \"Add to Virtual Exhibit\" on an object's page.</li>    <li>To complete your exhibit, click on \"My Exhibit\" in the left menu, fill out a title, your e-mail address and name, and a descriptive label.</li>    <li>Click \"Submit\" and you've curated an exhibit! Check your e-mail for a link to share your exhibit.</li></ul><img src='http://collections.centerofthewest.org/img/animation.gif'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='http://collections.centerofthewest.org/img/help.jpg'></div>";
	if(getCookie("CakeCookie[vgal]")=="")
		{
			event.preventDefault();
			$('body').append(lightbox)
			event.preventDefault();
			$('a.closebutton').unbind('click');			
		}
});
	}

function getCookie(gcname)
{
var name = gcname + "=";
var ca = document.cookie.split(';');
for(var i=0; i<ca.length; i++) 
  {
  var c = ca[i].trim();
  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
return "";
}

function dropCookie(noc){
if (noc=="both") {
document.cookie = "CakeCookie[vgal]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
document.cookie = "CakeCookie[editflag]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
}
else if (noc=="all") {
document.cookie = "CakeCookie[vgal]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
document.cookie = "CakeCookie[editflag]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
document.cookie = "CakeCookie[first]=0; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
}
else{
document.cookie = "CakeCookie["+noc+"]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
}
}

function setCookie(cval)
{
	var vgal=getCookie("CakeCookie[vgal]");
	var res = vgal.split(" ");
	var idx = res.indexOf(cval);
	//to prevent adding things over and over..
	if (idx > -1 ) 
		return false;
	else
	{
		//console.log(idx);
		document.cookie = "CakeCookie[vgal]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
		vgal=cval+' '+vgal;
		document.cookie = "CakeCookie[vgal]=" + vgal + "; path=/";
		
		if(getCookie("CakeCookie[vgal]")=="")
			{$("#ExNum").text('None');}
		else
			{
				$("#ExNum").fadeOut(500,function(){$(this).text(getCookie("CakeCookie[vgal]").split(" ").length).fadeIn(500);});
				
			
			}
			
	}	
}
function makerCook(makerval)
{
document.cookie = "CakeCookie[maker]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
document.cookie = "CakeCookie[maker]=" + makerval + "; path=/";
}
function medvalCook(makerval)
{
document.cookie = "CakeCookie[medval]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
document.cookie = "CakeCookie[medval]=" + makerval + "; path=/";
}

function editCookie(code){
	document.cookie = "CakeCookie[edit]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
	document.cookie = "CakeCookie[edit]=" + code + "; path=/";
	
}

function deleteCookie(dcname)
{
	var vgal=getCookie("CakeCookie[vgal]");
	

	var res = vgal.split(" ");
	
	var idx = res.indexOf(dcname);
	if (idx > -1) res.splice(idx, 1);
	res=res.join(" ");
	if(getCookie("CakeCookie[vgal]").split(" ").length<=1)	
	{
		if(confirm('This is the last item in your Virtual Gallery, removing it will delete your pack'))
		{
			console.log("finaly!");
			//delete
			document.cookie = "CakeCookie[vgal]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
			//then add
			document.cookie = "CakeCookie[vgal]=" + res + "; path=/";
			//then redirect.
			window.location.replace('http://oc.bbhclan.org/treasures/dopack/d:all');	
		}
		else
		{
			return;
		}
	}
	else
	{
		//console.log("else triggered");
		//delete
		document.cookie = "CakeCookie[vgal]=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/" ;
		//then add
		document.cookie = "CakeCookie[vgal]=" + res + "; path=/";	
	}	



	
	
		if(getCookie("CakeCookie[vgal]")=="")
			{$("#ExNum").text('None');}
		else
			{$("#ExNum").fadeOut(500,function(){$(this).text(getCookie("CakeCookie[vgal]").split(" ").length).fadeIn(500);});}
}
//this function either sets the unload message to the other function (unloadMessage), but if you pass off/false it then unregisters it.
function setConfirmUnload(on) {      
	window.onbeforeunload = (on) ? unloadMessage : null;
}
function unloadMessage() {   
     return 'You have entered new data on this page.' +' If you navigate away from this page without' +' first saving your data, the changes will be' +' lost.';
}