<html>
<head>
<title>Update DB script</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<xmp>
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

if (!isset($GB_TBL['cap']) || empty($GB_TBL['cap'])) {
	echo "Please update config.inc.php first.";
	exit;
}

$sqlquery[] = "ALTER TABLE `{$GB_TBL['data']}` CHANGE `browser` `browser` TINYTEXT";
$sqlquery[] = "ALTER TABLE `{$GB_TBL['priv']}` CHANGE `browser` `browser` TINYTEXT";
$sqlquery[] = "ALTER TABLE `{$GB_TBL['data']}` CHANGE `host` `host` VARCHAR(255) DEFAULT NULL";
$sqlquery[] = "ALTER TABLE `{$GB_TBL['priv']}` CHANGE `host` `host` VARCHAR(255) DEFAULT NULL";
$sqlquery[] = "ALTER TABLE `{$GB_TBL['data']}` CHANGE `email` `email` VARCHAR(100) DEFAULT NULL";
$sqlquery[] = "ALTER TABLE `{$GB_TBL['priv']}` CHANGE `email` `email` VARCHAR(100) DEFAULT NULL";
$sqlquery[] = "ALTER TABLE `{$GB_TBL['data']}` CHANGE `location` `location` VARCHAR(100) DEFAULT NULL";
$sqlquery[] = "ALTER TABLE `{$GB_TBL['priv']}` CHANGE `location` `location` VARCHAR(100) DEFAULT NULL";
$sqlquery[] = "ALTER TABLE `{$GB_TBL['com']}` CHANGE `host` `host` VARCHAR(255) DEFAULT NULL";
$sqlquery[] = "ALTER TABLE `{$GB_TBL['com']}` ADD INDEX (`id`)";

$sqlquery[] = "CREATE TABLE {$GB_TBL['cap']} (
	session_id char(32) DEFAULT '' NOT NULL,
	validate_key varchar(64) NOT NULL,
	timestamp int(11) unsigned NOT NULL,
	PRIMARY KEY (session_id)
)";

$db = new gbook_sql();
$db->connect();
$res = $db->query("SHOW TABLES LIKE '{$GB_TBL['cap']}'");
$result = $db->fetch_array($res);

if ($result == false) {
	echo "Updating db from 2.3.x to 2.4.3 \n\n";
	for ($i=0; $i<count($sqlquery); $i++) {
		$db->query($sqlquery[$i]);
		echo " - $sqlquery[$i]\n";
	}
	echo "------------\n\n Update finished.";
} else {
	echo "No update required.";
}

?>
</xmp>
</body>
</html>

