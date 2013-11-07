<div id="header">
	<div id="center" style="width: 100%; margin-left: auto; margin-right: auto; margin-bottom: 10px">
        <a href="/"><img style="display:block;" src="images/alertbanner.png" alt="Courtesy of Kamteix!"/></a>
        <div class="header_links" id="links" style="width: 350px">
            <a class="header_links" href="submitresult.php">Submit Result</a>
			<a class="header_links" href="/">Statistics</a>
        </div>
		<?php if ($subheader == 1)
		{
			echo '<div class="header_links" id="subheader_links" style="width: 255px; margin-left: auto; margin-right: auto;">';
		}
		else
			echo '<div class="header_links" id="subheader_links" style="display: none;">';
		?>
					<a class="subheader_links" href="/">General Stats</a>
					<a class="subheader_links" href="allalerts.php">All Alerts</a>
				</div>
    </div>
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-15631800-10', 'ps2alerts.com');
  ga('send', 'pageview');

</script>