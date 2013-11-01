<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<form id="API_input" action="api_poll.php">
	Result ID:
	<input type="text" name="ResultID" />
	
<br />
<br />

	Server:
	<select name="ResultServer" id="ResultServerSelect" >
		<option value="25" >Briggs</option>
		<option value="11" >Ceres</option>
		<option value="13" >Cobalt</option>
		<option value="1"  >Connery</option>
		<option value="17" >Mattherson</option>
		<option value="10" >Miller</option>
		<option value="18" >Waterson</option>
		<option value="9"  >Woodman</option>
	</select>

<br />
<br />

	Result Alert Type:
	<select name="ResultAlertType" id="ResultServerSelect" >
		<option value="Amp" >Amp</option>
		<option value="Bio" >Bio</option>
		<option value="Tech">Tech</option>
		<option value="Territory" >Territory</option>
	</select>
	
<br />
<br />

	Continent:
	<select name="ResultAlertType" id="ResultServerSelect" >
		<option value="Cross" >Cross (0)</option>
		<option value="Indar" >Indar (2)</option>
		<option value="Esamir" >Esamir (6)</option>
		<option value="Amerish" >Amerish (8)</option>
	</select>
	
<br />
<br />

<input type="hidden" name="mode" value="input" />
<input type="submit" name="submit" value="submit" />
</form>

</body>
</html>