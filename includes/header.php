<?php 

$progress = $_REQUEST["progress"];

if ($progress == "1") 
{
	include("header_test.php");
}
else
{
	include("header_current.php");
}

?>