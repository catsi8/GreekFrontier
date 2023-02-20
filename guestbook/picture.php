<?php
$include_path = dirname(__FILE__);
require_once $include_path."/admin/config.inc.php";

function stripChars($imgFile) {
	$illegalChars = array(
			"?"  => "",
			"\\" => "",
			":"  => "",
			"*"  => "",
			"\"" => "",
			"<"  => "",
			">"  => "",
			"|"  => "",
			"../"=> "",
			"./" => "",
			"\n" => "",
			"\r" => "",
			"\t" => ""
	);
	return trim(strtr($imgFile, $illegalChars));
}

$border = 18;
$size = array();
$picture = "";

if (isset($_GET['img'])) {
    $imgFile = stripChars($_GET['img']);
    if (!empty($imgFile) && is_file("$include_path/$GB_TMP/$imgFile")) {
        $size = GetImageSize("$include_path/$GB_TMP/$imgFile");
        $picture = "$GB_PG[base_url]/$GB_TMP/$_GET[img]";
    } else {
    	$imgFile = stripChars($_GET['img']);
    	if (!empty($imgFile) && is_file("$include_path/$GB_UPLOAD/$imgFile")) {
    	    if (eregi("(^t_)(img-[0-9]+.[a-z]{3})", $imgFile, $regs)) {
    	        $size = GetImageSize("$include_path/$GB_UPLOAD/$regs[2]");
    	        $picture = "$GB_PG[base_url]/$GB_UPLOAD/$regs[2]";
    	    } else {
    	        $size = GetImageSize("$include_path/$GB_UPLOAD/$_GET[img]");
    	        $picture = "$GB_PG[base_url]/$GB_UPLOAD/$imgFile";
    	    }
    	}
    }
}
if (isset($size[1]) && $size[1]>100) {
	$tbl_height = $size[1]+$border;
	$tbl_width = "100%";
} else {
	$tbl_height = 100;
	$tbl_width = 100+$border;
}

?>
<html>
<head>
<title>Guestbook</title>
</head>
<body bgcolor="#CCCCCC" topmargin="0">
<table width="<?php echo $tbl_width; ?>" border="0" cellspacing="0" cellpadding="0" height="<?php echo $tbl_height; ?>">
  <tr>
    <td>
    <?php
        if (!empty($picture)) {
            echo "<a href=\"javascript:window.close()\"><img src=\"$picture\" width=\"$size[0]\" height=\"$size[1]\" border=\"0\"></a>\n";
        }
    ?>
    </td>
  </tr>
</table>
</body>
</html>

