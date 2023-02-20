<?php
$include_path = dirname(__FILE__);
require_once $include_path."/admin/config.inc.php";
require_once $include_path."/lib/$DB_CLASS";
require_once $include_path."/lib/captcha.class.php";

if (USE_CAPTCHA) {
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$_GET['id'] = trim($_GET['id']);
		$id = addslashes($_GET['id']);
		$expired = time() - 1200;
		$db = new gbook_sql();
		$db->connect();
		$db->query("DELETE FROM {$GB_TBL["cap"]} WHERE timestamp < $expired");
		$res = $db->query("SELECT * FROM {$GB_TBL["cap"]} WHERE session_id='$id' LIMIT 1");
		$result = $db->fetch_array($res);
		if (isset($result['validate_key'])) {
			$imageType = "";			
			if (extension_loaded("gd")) {				
				$img = new SimpleCaptcha();
				$img->setFontSizeRange(14,18);
				reset($img->supportedImagesTypes);
				$imageType = key($img->supportedImagesTypes);	
				$img->setText($result['validate_key']);			
			} else {
				require_once $include_path."/lib/bitmapimagetext.class.php";
				$img = new BitmapImageText();
				$img->setText(strtoupper($result['validate_key']));
			}
			$img->setBackgroundColors(array("EEEEEE", "F2F3D3", "F5EAEA", "E4F3EE", "EEE4F3", "FFE6E6"));
			$img->setTextColors(array("000000", "FD130A", "0A1BFD", "149703", "486C66", "870DC3", "D78406", "105243"));
			if (!empty($imageType)) {
				$img->getImage($imageType);
			} else {
				$img->getImage();
			}
			exit();
		}
	}
}

SimpleCaptcha::createPixel();

?>
