<?php 
include("includes/mysqlconnect.php");

$reportTime = $_POST["reportTime"];
$reportServer = $_POST["reportServer"];
$reportType = $_POST["reportType"];
$reportCont = $_POST["reportCont"];
$reportIP = $_SERVER['REMOTE_ADDR'];

echo '<pre>';
var_dump($_POST);
echo '</pre>';

$report_submit_query = mysql_query("INSERT INTO alert_reports (reportTime, reportServer, reportType, reportCont, reportIP) VALUES ('".$reportTime."', '".$reportServer."', '".$reportType."', '".$reportCont."', '".$reportIP."')");

if (!$report_submit_query) 
{
	echo "ERROR!". mysql_error();
} 
else 
{
	//echo 'Query successful!';
	
	header("Location: thanks.php");
}

?>