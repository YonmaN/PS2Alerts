<?php // test header // ?>

<div id="header">
	<div id="center" style="width: 100%; margin-left: auto; margin-right: auto; margin-bottom: 10px">
		<a href="/"><img style="display:block;" src="images/alertbanner.png" alt="Courtesy of Kamteix!"/></a>
		<div id="header_float" style="height: 125px; margin-bottom: 10px; display: table; margin-top: 7px;">
			<div id="header_left" style="display: table-cell; vertical-align: middle;">
				<div class="header_links" id="links" style="width: 360px; margin-left: 100px;">
					<a class="header_links" href="submitresult.php" style="background-image: none;">Submit Result</a> 
					<a class="header_links" href="/" style="background-image: none;">Statistics</a>
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
		
			<div id="header_right" style="margin-left: 150px;">
				<div id="progress" style="border-radius: 10px; background-image: url(../images/content_background.png); padding: 5px;">
					<div id="progress_left_top" style="width: 100%;">
					<?php 
						$reported_alerts_query = mysql_query("SELECT * FROM alert_reports");
						$count = mysql_num_rows($reported_alerts_query);
					?>
						<p class="header_links_text" style="color: red;"><?php echo $count;?> Alerts in progress</p>
						<a class="header_links_text" href="alertreport.php" style="color: red; font-size: 12px; text-align: center; display: block">Report an ongoing alert</a>
					</div>
					<div id="progress_left_bottom" style="margin-top: 3px;">
						
							<?php 
							echo '<table id="reports" width="260" cellpadding=0">';
							
							echo '<tr>';
								echo '<td class="table_item_text" style="font-size: 14px;">';
									echo '';
								echo '</td>';
								echo '<td class="table_item_text" style="font-size: 14px;">';
									echo 'End';
								echo '</td>';
								echo '<td class="table_item_text" style="font-size: 14px;">';
									echo 'Server';
								echo '</td>';
								echo '<td class="table_item_text" style="font-size: 14px;">';
									echo 'Type';
								echo '</td>';
								echo '<td class="table_item_text" style="font-size: 14px;">';
									echo 'Cont';
								echo '</td>';
							echo '</tr>';
							while($reports = mysql_fetch_array($reported_alerts_query)) 
							{	
								echo '<tr>';
								echo '<td>';
									echo '<video width="25" height="25" autoplay loop>';
										echo '<source src="images/AlertAnim2.mp4" type"video/mp4">';
									echo '</video>';
								echo '</td>';								
										echo '<td class="form_item_text" style="font-size: 12px; text-align: center;">';
											echo $reports["reportTime"];
										echo '</td>';
										echo '<td class="form_item_text" style="font-size: 12px; text-align: center;">';
										
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
										echo '<td class="form_item_text" style="font-size: 12px; text-align: center;">'.$reports["reportType"].'</td>';
										echo '<td class="form_item_text" style="font-size: 12px; text-align: center;">'.$reports["reportCont"].'</td>';
									echo '</tr>';
							}
							echo '</table>';
							?>
					</div>
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