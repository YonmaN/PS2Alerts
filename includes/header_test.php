<?php // test header // ?>

<div id="header">
	<div id="center" style="width: 100%; margin-left: auto; margin-right: auto; margin-bottom: 10px">
		<a href="/"><img style="display:block;" src="images/alertbanner.png" alt="Courtesy of Kamteix!"/></a>
		<div id="header_float" style="height: 105px; margin-bottom: 10px;">
			<div id="header_left" style="float: left;">
				<div class="header_links" id="links" style="width: 350px; margin-left: 100px;">
					<a class="header_links" href="submitresult.php">Submit Result</a> <a class="header_links" href="/">Statistics</a>
				</div>
				<?php if ($subheader == 1)
			{
				echo '<div class="header_links" id="subheader_links" style="width: 255px; margin-left: 150px; margin-right: auto;">';
			}
			else
				echo '<div class="header_links" id="subheader_links" style="display: none;">';
			?>
				<a class="subheader_links" href="/">General Stats</a> <a class="subheader_links" href="allalerts.php">All Alerts</a>
			</div>
		</div>
		
		<!-- TESTING -->
		
		<div id="header_right" style="float: right;">
			<div id="progress" style="width: 300px; margin-right: 100px; height: 90px; margin-top: 7px; border-radius: 10px; background-image: url(../images/content_background.png); padding: 5px;">
				<div id="progress_left_top" style="height:30px; width: 100%;">
					<p class="header_links_text" style="color: red;">Alerts in progress</p>
				</div>
				<div id="progress_left_bottom" style="height: 60px;">
					<?php 
						$reported_alerts_query = mysql_query("SELECT * FROM alert_reports LIMIT 2");
						
						while($reports = mysql_fetch_array($reported_alerts_query)) 
						{	
							echo '<div id="alert_report_'.$reports["reportID"].'" style="display: inline-block; height: 25px;">';
								echo '<video width="25" height="25" autoplay loop>';
									echo '<source src="images/AlertAnim2.mp4" type"video/mp4">';
								echo '</video>';
								//echo '<div id="spacer" style="margin-top: 3px; vertical-align: top; display: inline-block;">';
								
								echo '<table id="reports" width="260" cellpadding=5" style="display:inline-block">';
								echo '<tr>';
									echo '<td class="form_item_text">';
										echo $reports["reportTime"];
									echo '</td>';
									echo '<td class="form_item_text">';
									
									if ($reports['reportServer'] == "1")
										{
											$ReportServer = "Connery";
										} else if ($reports['reportServer'] == "9")
										{
											$ReportServer = "Woodman";
										} else if ($reports['reportServer'] == "9")
										{
											$ReportServer = "Woodman";
										} else if ($reports['reportServer'] == "10")
										{
											$ReportServer = "Miller";
										} else if ($reports['reportServer'] == "11")
										{
											$ReportServer = "Ceres";
										} else if ($reports['reportServer'] == "13")
										{
											$ReportServer = "Cobalt";
										} else if ($reports['reportServer'] == "17")
										{
											$ReportServer = "Mattherson";
										} else if ($reports['reportServer'] == "18")
										{
											$ReportServer = "Waterson";
										} else if ($reports['reportServer'] == "25")
										{
											$ReportServer = "Briggs";
										} 	
										
										echo $ReportServer;
									echo '</td>';
									echo '<td class="form_item_text" >'.$reports["reportType"].'</td>';
									echo '<td class="form_item_text" >'.$reports["reportCont"].'</td>';
								echo '</tr>';
							echo '</table>';
						echo '</div>';
						}
						?>
				</div>
			</div>
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
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'ps2alerts'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
</script>