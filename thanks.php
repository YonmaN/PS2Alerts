<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("includes/includes.php")?>
<?php include("includes/mysqlconnect.php")?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Planetside 2 Statistics Index</title>
</head>

<body>
<div id="wrapper">

	<?php include('includes/header.php') ?>
    
    <div class="content" id="content">
	
	<?php 
	
	$Message = $_REQUEST["Message"];
	
	if ($Message == 1)
	{
		echo '<p class="form_headers">There has already been an alert submitted within the past hour.</p> ';
		echo '<p class="form_headers">Please check again later!</p>';
	} 
	else if ($Message == 2)
	{
		$SubmitterIP = $_SERVER['REMOTE_ADDR'];
		$bans_query = mysql_query ("SELECT IPBanned, Comment FROM bans WHERE IPBanned = '$SubmitterIP'");
		$bans = mysql_fetch_array($bans_query);
		
		echo '<p class="form_headers">You have been banned from submitting Alert Statistics.</p>';
		echo '<p class="form_item_text">Reason: '. $bans["Comment"];
	} else if ($Message == 3)
	{
		echo '<p class="form_headers">This alert doesnt exist!</p>';
		echo '<p class="form_item_text" style="text-align: center; font-size: 20px;">This alert may have been deleted for the following reasons:</p>';
		echo '<ul class="form_item_text">';
			echo '<li class="form_item_text">The alert may have been a false result and deleted to maintain statistical integrity.</li>';
			echo '<li class="form_item_text">The alert data may have been malformed, which has been deleted to maintain proper results.</li>';
			echo '<li class="form_item_text">The alert may have been submitted by a spam bot, or a malicious user. <span style="color: #F00;">(Beware, if we find people doing this, they will be banned!)</span></li>';
			echo '<li class="form_item_text">The alert data may have been for testing purposes.</li>';
		echo '</ul>';
	} else {
		
		$last_alert_query = mysql_query ("SELECT ResultID FROM results2 ORDER BY ResultID DESC LIMIT 1");
		$last_alert = mysql_fetch_array($last_alert_query);
		
		echo '<p class="form_headers">Thanks for your submission!</p>';
		echo '<p class="form_item_text" style="text-align: center;">Thank you for your alert submission! You can now view the details for the alert <a class="stats_highlight" style="font-size: 16px" href="alertdetail.php?AlertID='.$last_alert["ResultID"].'">here</a>.</p>';
	}
	?>
  </div>
</div>
</body>
</html>