<?php // Alert Title Change

$title_query = mysql_query("SELECT ResultID FROM results2 WHERE ResultID = ".$_REQUEST["AlertID"]." ");
$title = mysql_fetch_array($title_query);

echo '<title>Alert #'.$title["ResultID"].'</title>';


?>