<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Create new password</title>
</head>
<body>
<?php
if (file_exists("../admin/config.inc.php")) {
	include_once "../admin/config.inc.php";
	include_once "../lib/$DB_CLASS";
} elseif (file_exists("./admin/config.inc.php")) {
	include_once "./admin/config.inc.php";
	include_once "./lib/$DB_CLASS";
} else {
	echo "Can't find config.inc.php";
	exit();
}
$GB_DB = array();

function showForm($message="") {
	echo "
	<h3>$message</h3>
	<form name=\"dbForm\" method=\"post\" action=\"{$_SERVER['PHP_SELF']}\">
	<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
		<tr>
			<td width=\"120\">Hostname</td>
			<td><input name=\"data[host]\" type=\"text\" value=\"localhost\"></td>
		</tr>
		<tr>
			<td>Database</td>
		<td><input type=\"text\" name=\"data[db]\"></td>
		</tr>
		<tr>
			<td>Username</td>
			<td><input type=\"text\" name=\"data[username]\"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type=\"password\" name=\"data[password]\"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input name=\"submit\" type=\"submit\" value=\"Submit\">
			<input type=\"reset\" value=\"Reset\">
			<input type=\"hidden\" name=\"go\" value=\"login\"></td>
		</tr>
	</table>
	</form>
	";
}

function showAccountForm($hidden="") {
	echo "
	<h3>Please enter a new username and password for the admin control panel.</h3>
	<form name=\"dbForm\" method=\"post\" action=\"{$_SERVER['PHP_SELF']}\">
	<table border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
		<tr>
			<td width=\"120\">Username</td>
			<td><input type=\"text\" name=\"data[username]\"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type=\"password\" name=\"data[password]\"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input name=\"submit\" type=\"submit\" value=\"Submit\">
			<input type=\"reset\" value=\"Reset\">
			<input type=\"hidden\" name=\"go\" value=\"change\">$hidden</td>
		</tr>
	</table>
	</form>
	";
}

function stripQuotes($postArr) {
	if (get_magic_quotes_gpc()) {
		foreach ($postArr as $key => $value) {
			$postArr[$key] = stripslashes($value);
		}
	}
	return $postArr;
}

$go = (isset($_POST['go'])) ? $_POST['go'] : "";

if (isset($_POST['data']) && is_array($_POST['data'])) {
	$_POST['data'] = stripQuotes($_POST['data']);
}
switch ($go) {

	case "login":
		$GB_DB["dbName"] = (isset($_POST['data']['db'])) ? $_POST['data']['db'] : "";
		$GB_DB["host"]   = (isset($_POST['data']['host'])) ? $_POST['data']['host'] : "";
		$GB_DB["user"]   = (isset($_POST['data']['username'])) ? $_POST['data']['username'] : "";
		$GB_DB["pass"]   = (isset($_POST['data']['password'])) ? $_POST['data']['password'] : "";
		if ($GB_DB["dbName"] == "" || $GB_DB["host"] == "" || $GB_DB["user"] == "") {
			showForm("Please enter database, hostname and username!");
		} else {
			$db = new gbook_sql();
			$db->connect();
			$hidden = "";
			foreach ($GB_DB as $key => $value) {
				$hidden .= "<input type=\"hidden\" name=\"gbdb[$key]\" value=\"".htmlspecialchars($value)."\">";
			}
			showAccountForm($hidden);
		}
		break;

	case "change":
		if (isset($_POST['gbdb']) && is_array($_POST['gbdb'])) {
			$_POST['gbdb'] = stripQuotes($_POST['gbdb']);
		}
		$GB_DB["dbName"] = (isset($_POST['gbdb']['dbName'])) ? $_POST['gbdb']['dbName'] : "";
		$GB_DB["host"]   = (isset($_POST['gbdb']['host'])) ? $_POST['gbdb']['host'] : "";
		$GB_DB["user"]   = (isset($_POST['gbdb']['user'])) ? $_POST['gbdb']['user'] : "";
		$GB_DB["pass"]   = (isset($_POST['gbdb']['pass'])) ? $_POST['gbdb']['pass'] : "";
		$db = new gbook_sql();
		$db->connect();
		if (!empty($_POST['data']['username']) && !empty($_POST['data']['password'])) {		
			$username = addslashes($_POST['data']['username']);
			$password = addslashes($_POST['data']['password']);
			$db->query("UPDATE {$GB_TBL['auth']} SET username='$username', password=PASSWORD('$password') WHERE ID='1'");
			echo "<h3>Username and password changed.</h3>";
		} else {
			echo "<h3>Username or password is empty.</h3>";
		}
		break;

	default:
		showForm();
}
?>
</body>
</html>

