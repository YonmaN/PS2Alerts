<script type="text/javascript">
animatedcollapse.addDiv('siteinfo', 'fade=1,height=360px')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>

<script>
function setCookie()
{
	var today = new Date();
	var expire = new Date();
	expire.setTime(today.getTime() + 3600000*24*365);
	document.cookie = "read=1;expires="+expire.toGMTString();
}

</script>


<div class="content" id="siteinfo" style="margin-bottom: 10px">
	<p class="form_headers">Site is currently under construction!</p>
	<p class="form_item_text">The aim of this project is collect statistical and analyitical data for Alerts within Planetside 2.</p>
	<p class="form_item_text">The project is now in such a state were alerts can be submitted to <b>all</b> servers. I'm currently working on creating statistical data for every server. For now, Miller has the most submissions, and therefore the most accurate statistics.</p>
	<p class="form_item_text">More information can be found at our <a class="stats_highlight" href="http://redd.it/1mex3g" style="font-size:16px">Reddit post</a> on the <a class="stats_highlight" href="http://www.reddit.com/r/MillerPlanetside/" style="font-size:16px">Miller Subreddit</a>. If you have any feedback, please contact the developer (Maelstrome26 on Miller). Send me a message via <a class="stats_highlight" href="mailto:maelstrome26@gmail.com" style="font-size:16px">Email</a> or <a class="stats_highlight" href="http://twitter.com/Maelstrome26" style="font-size:16px">Twitter</a> if you like, feedback is appricated!</p>
	<p class="form_item_text">Disclaimer: There may be bugs present in this site, as this is <b>NOT</b> a final build! If you have issues with the site, please contact me by using the above details!</p>
	<p class="form_item_text">Updated: 24/10/13</p>
	<span style="margin-left: 290px; cursor:pointer; text-decoration:underline;"><a onclick="animatedcollapse.hide('siteinfo'), setCookie()" class="form_headers">Got it!</a></span>
</div>