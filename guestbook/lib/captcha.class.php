<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.4.3 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */
/**
 * Usage
 * <pre>
 *   $img = new SimpleCaptcha();
 *   $img->setText("AFhQW4");
 *   $img->setBackgroundColors(array("EEEEEE", "F2F3D3", "F5EAEA", "E4F3EE", "EEE4F3"));
 *   $img->setTextColors(array("000000", "FD130A", "0A1BFD", "149703", "486C66", "870DC3", "D78406", "105243"));
 *   $img->setFontSizeRange(12,18);
 *   $img->getImage();
 * </pre>
 */
 
class SimpleCaptcha {

	var $width;
	var $height;
	var $text;
	var $imgRes;
	var $textColors;
	var $backgroundColors;
	var $fontFiles;
	var $fontSizeRange;
	var $angleRange;
	var $randYOrdinate;
	var $length;
	var $letterSpacingX;
	var $paddingLeft;
	var $useGrid;
	var $gridColor;
	var $gridSize;
	var $fontDir;
	var $hasGDSupport;
	var $hasTTFSupport;
	var $supportedImagesTypes;
	var $charArr;
	var $textArr;

	function SimpleCaptcha() {
		$this->width = 80;
		$this->height = 35;
		$this->text = NULL;
		$this->textColors = array(array(0,0,0));
		$this->backgroundColors = array(array(255,255,255));
		$this->imgRes = NULL;
		$this->fontDir = dirname(__FILE__)."/fonts";
		$this->fontSizeRange = array(5,5);
		$this->angleRange = array(-5,5);
		$this->randYOrdinate = array(4,10);
		$this->length = array();
		$this->letterSpacingX = 1;
		$this->letterSpacingY = 1;
		$this->paddingLeft = 10;
		$this->useGrid = true;
		$this->gridColor = array(182,197,221);
		$this->gridSize = 10;
		$this->fontFiles = array();
		$this->hasGDSupport = (extension_loaded("gd")) ? true : false;
		$this->hasTTFSupport = ($this->hasGDSupport && function_exists("imagettftext")) ? true : false;
		if ($this->hasGDSupport) {
			$this->getSupportedImagesTypes();
		}
		if ($this->hasTTFSupport == true) {
			if (is_dir($this->fontDir) && is_readable($this->fontDir)) {
				chdir($this->fontDir);
				$handle = opendir('.');
				while ($file = readdir($handle)) {
					if (preg_match("/\.ttf/i", $file)) {
						$this->addFontFile($this->fontDir."/$file");
					}
				}
				closedir($handle);
			}
			$this->fontSizeRange = array(14,16);
			$this->ttfConfig();
		}
	}

	function setText($text) {
		$text = trim($text);
		if (!empty($text)) {
			$this->text = $text;
			$this->textArr = array();
			if (is_resource($this->imgRes)) {
				imagedestroy($this->imgRes);
			}
			return true;
		}
		return false;
	}

	function setBackgroundColor($htmlColorCode) {
		$rgbArr = $this->getRGBCode($htmlColorCode);
		if (count($rgbArr)>0) {
			unset($this->backgroundColors);
			$this->backgroundColors[] = $rgbArr;
			return true;
		}
		return false;
	}

	function setBackgroundColors($htmlColorCodeArr) {
		$retval = false;
		foreach ($htmlColorCodeArr as $key => $value) {
			$rgbArr = $this->getRGBCode($value);
			if (count($rgbArr)>0) {
				if ($retval == false) {
					unset($this->backgroundColors);
					$retval = true;
				}
				$this->backgroundColors[] = $rgbArr;
			}
		}
		return $retval;
	}

	function setTextColor($htmlColorCode) {
		$rgbArr = $this->getRGBCode($htmlColorCode);
		if (count($rgbArr)>0) {
			unset($this->textColors);
			$this->textColors[] = $rgbArr;
			return true;
		}
		return false;
	}

	function setTextColors($htmlColorCodeArr) {
		$retval = false;
		foreach ($htmlColorCodeArr as $key => $value) {
			$rgbArr = $this->getRGBCode($value);
			if (count($rgbArr)>0) {
				if ($retval == false) {
					unset($this->textColors);
					$retval = true;
				}
				$this->textColors[] = $rgbArr;
			}
		}
		return $retval;
	}

	function setFontSize($fontSize) {
		$fontSize = intval($fontSize);
		if ($this->hasTTFSupport) {
			if ($fontSize >= 8) {
				$this->setFontSizeRange($fontSize, $fontSize);
				return true;
			}
		} else {
			if ($fontSize > 0 && $fontSize <= 5) {
				$this->setFontSizeRange($fontSize, $fontSize);
				return true;
			}
		}
		return false;
	}

	function setFontSizeRange($minFontSize, $maxFontSize) {
		if ($maxFontSize >= $minFontSize) {
			if ($this->hasTTFSupport) {
				if ($minFontSize >= 6 && $maxFontSize >= 6) {
					$this->fontSizeRange[0] = $minFontSize;
					$this->fontSizeRange[1] = $maxFontSize;
					return true;
				}
			} else {
				if ($minFontSize >= 1 && $maxFontSize >= 1) {
					if ($minFontSize <=5 && $minFontSize <=5) {
						$this->fontSizeRange[0] = $minFontSize;
						$this->fontSizeRange[1] = $maxFontSize;
					}
					return true;
				}
			}
		}
		return false;
	}

	function setFontFile($fontFile) {
		if ($this->hasTTFSupport) {
			if (is_readable($fontFile)) {
				$this->fontFiles = array($fontFile);
				return true;
			}
		}
		return false;
	}

	function addFontFile($fontFile) {
		if ($this->hasTTFSupport) {
			if (is_readable($fontFile)) {
				$this->fontFiles[] = $fontFile;
				return true;
			}
		}
		return false;
	}

	function addFontFiles($fontFileArr) {
		if ($this->hasTTFSupport) {
			foreach ($fontFileArr as $key => $value) {
				$this->addFontFile($value);
			}
		}
	}

	function setImageWidth($width) {
		$width = intval($width);
		if ($width > 0) {
			$this->width = $width;
			return true;
		}
		return false;
	}

	function setImageHeight($height) {
		$height = intval($height);
		if ($height > 0) {
			$this->height = $height;
			return true;
		}
		return false;
	}

	function getImageFile($filename, $type="png") {
		if ($this->hasGDSupport == false) {
			return NULL;
		}
		$filename = trim($filename);
		$saveDir = dirname($filename);
		if (!is_writable($saveDir)) {
			return NULL;
		}
		if (file_exists($filename) && !is_writable($filename)) {
			return NULL;
		}
		$retVal = NULL;
		if (!$this->createImage()) {
			return NULL;
		}
		$type = strtolower($type);
		switch ($type) {
			case "jpeg":
			case "jpg":
				if (isset($this->supportedImagesTypes['jpg'])) {
					imagejpeg($this->imgRes, $filename);
					$retVal = $filename;
				}
				break;

			case "png":
				if (isset($this->supportedImagesTypes['png'])) {
					imagepng($this->imgRes, $filename);
					$retVal = $filename;
				}
				break;

			case "gif":
				if (isset($this->supportedImagesTypes['gif'])) {
					imagegif($this->imgRes, $filename);
					$retVal = $filename;
				}
				break;

			default:
				if (isset($this->supportedImagesTypes['png'])) {
					imagepng($this->imgRes, $filename);
					$retVal = $filename;
				}
		}
		imagedestroy($this->imgRes);
		return $retVal;
	}

	function getImage($type="png") {
		if ($this->hasGDSupport == false) {
			$this->createPixel();
		} else {
			if ($this->createImage()) {
				$type = strtolower($type);
				switch ($type) {
					case "jpeg":
					case "jpg":
						if (isset($this->supportedImagesTypes['jpg'])) {
							header("Content-Type: image/jpeg");
							imagejpeg($this->imgRes);
						}
						break;

					case "png":
						if (isset($this->supportedImagesTypes['png'])) {
							header("Content-Type: image/png");
							imagepng($this->imgRes);
						}
						break;

					case "gif":
						if (isset($this->supportedImagesTypes['gif'])) {
							header("Content-Type: image/gif");
							imagegif($this->imgRes);
						}
						break;

					default:
						if (isset($this->supportedImagesTypes['png'])) {
							header("Content-Type: image/png");
							imagepng($this->imgRes);
						}
				}
				imagedestroy($this->imgRes);
			} else {
				$this->createPixel();
			}
		}
	}

	function createPixel() {
		$date = date("D, d M Y H:i:s");
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
		header("Content-Type: image/png");
		header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");
		header("Last-Modified: $date GMT");
		echo base64_decode("iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAABlBMVEX///8AAABVwtN+AAAAB3RJTUUH1gMKDhsHHWK8FQAAAApJREFUeJxjYAAAAAIAAUivpHEAAAAASUVORK5CYII=");
	}

	/**
	 * private methods
	 */

	function ttfConfig() {
		$this->angleRange = array(-25,25);
		$this->letterSpacingX = 1.3;
		$this->letterSpacingY = 1.7;
		$this->randYOrdinate = array(0,8);
	}

	function gdConfig() {
		$this->fontSizeRange = array(5,5);
		$this->angleRange = array(-5,5);
		$this->letterSpacingX = 1;
		$this->letterSpacingY = 1;
		$this->randYOrdinate = array(4,10);
	}

	function getSupportedImagesTypes() {
		if (count($this->supportedImagesTypes)>0) {
			return $this->supportedImagesTypes;
		}
		if (imagetypes() & IMG_JPG) {
			$this->supportedImagesTypes['jpg'] = true;
		}	
		if (imagetypes() & IMG_GIF) {
			$this->supportedImagesTypes['gif'] = true;
		}
		if (imagetypes() & IMG_PNG) {
			$this->supportedImagesTypes['png'] = true;
		}
		return $this->supportedImagesTypes;
	}

	function getRGBCode($htmlColorCode) {
		$rgbArr = array();
		if (strlen($htmlColorCode) == 6) {
			$htmlCodeArr = array();
			eregi("([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})", $htmlColorCode, $htmlCodeArr);
			if (count($htmlCodeArr) == 4) {
				for ($i=1; $i<=3; $i++) {
					$k = $i-1;
					$rgbArr[$k] = hexdec($htmlCodeArr[$i]);
				}
				return $rgbArr;
			}
		}
		return $rgbArr;
	}

	function createImage() {
		$retVal = false;
		if ($this->hasTTFSupport && count($this->fontFiles)>0) {
			$retVal = $this->createImageTTF();
		} else {
			if ($this->hasTTFSupport) {
				$fontSizeRange = $this->fontSizeRange;
				$this->gdConfig();
				$retVal = $this->createImageStr();
				$this->fontSizeRange = $fontSizeRange;
			} else {
				$retVal = $this->createImageStr();
			}
		}
		return $retVal;
	}

	function getPreparedTextStr() {
		$this->textArr = array();
		if ($this->text != "") {
			$this->charArr = array();
			$charArr = preg_split('//', $this->text, -1, PREG_SPLIT_NO_EMPTY);
			srand((double)microtime()*1000000);
			$fontFileMaxIndex = count($this->fontFiles) - 1;
			for ($i=0; $i<count($charArr); $i++) {
				$randFontSize = rand($this->fontSizeRange[0], $this->fontSizeRange[1]);
				$this->charArr[] = array("fontsize" => $randFontSize, "char" => $charArr[$i]);
			}
		}
		return $this->charArr;
	}

	function getTextLengthStr() {
		$textLength = strlen($this->text);
		return ($textLength * 13);
	}

	function getTextHeightStr() {
		return ($this->randYOrdinate[1] + 15);
	}

	function createImageStr() {
		$this->getPreparedTextStr();
		if (count($this->charArr) == 0) {
			return false;
		}
		$minLength = $this->paddingLeft + $this->getTextLengthStr();
		if ($this->width < $minLength) {
			$this->width = $minLength;
		}
		$minHeight = $this->getTextHeightStr();
		if ($this->height < $this->letterSpacingY + $minHeight) {
			$this->height = $this->letterSpacingY + $minHeight;
		}
		srand((double)microtime()*1000000);
		$backgroundColorIndex = count($this->backgroundColors) - 1;
		$textColorIndex = count($this->textColors) - 1;
		$randBgIndex = rand(0,$backgroundColorIndex);
		$this->imgRes = @imagecreate($this->width, $this->height);
		if (!is_resource($this->imgRes)) {
			return false;
		}
		imagecolorallocate(
			$this->imgRes,
			$this->backgroundColors[$randBgIndex][0],
			$this->backgroundColors[$randBgIndex][1],
			$this->backgroundColors[$randBgIndex][2]
		);
		if ($this->useGrid == true) {
			$gridColor = imagecolorallocate($this->imgRes,$this->gridColor[0],$this->gridColor[1],$this->gridColor[2]);
			$i=0;
			while ($i<$this->height) {
				imageline($this->imgRes, 0, $i, $this->width, $i, $gridColor);
				$i += $this->gridSize;
			}
			$i=0;
			while ($i<$this->width) {
				imageline($this->imgRes, $i, 0, $i, $this->height, $gridColor);
				$i += $this->gridSize;
			}
		}
		for ($i=0; $i<count($this->charArr); $i++) {
			$xPos = $this->paddingLeft + (12 * $i);
			$randColorIndex = rand(0,$textColorIndex);
			imagestring(
				$this->imgRes,
				$this->charArr[$i]['fontsize'],
				$xPos,
				rand($this->randYOrdinate[0],$this->randYOrdinate[1]), $this->charArr[$i]['char'],
				imagecolorallocate(
					$this->imgRes,
					$this->textColors[$randColorIndex][0],
					$this->textColors[$randColorIndex][1],
					$this->textColors[$randColorIndex][2]
				)
			);
		}
		return true;
	}

	function getPreparedTextTTF() {
		$this->textArr = array();
		if ($this->text != "") {
			$this->charArr = array();
			$charArr = preg_split('//', $this->text, -1, PREG_SPLIT_NO_EMPTY);
			srand((double)microtime()*1000000);
			$fontFileMaxIndex = count($this->fontFiles) - 1;
			for ($i=0; $i<count($charArr); $i++) {
				$randFontSize = rand($this->fontSizeRange[0], $this->fontSizeRange[1]);
				$randAngle = rand($this->angleRange[0], $this->angleRange[1]);
				$randFontFileIndex = rand(0,$fontFileMaxIndex);
				$randFontFile = $this->fontFiles[$randFontFileIndex];
				$this->textArr[] = imagettfbbox($randFontSize, $randAngle, $randFontFile, $charArr[$i]);
				$this->charArr[] = array("fontsize" => $randFontSize, "angle" => $randAngle, "fontfile" => $randFontFile, "char" => $charArr[$i]);
			}
		}
		return $this->textArr;
	}

	function createImageTTF() {
		if (count($this->fontFiles) == 0) {
			return false;
		}
		if (count($this->textArr) == 0) {
			$this->getPreparedTextTTF();
		}
		$minLength = $this->paddingLeft + $this->getTextLength();
		if ($this->width < $minLength) {
			$this->width = $minLength;
		}
		$minHeight = $this->getTextHeight();
		if ($this->height < $this->letterSpacingY * $minHeight) {
			$this->height = $this->letterSpacingY * $minHeight;
		}
		srand((double)microtime()*1000000);
		$backgroundColorIndex = count($this->backgroundColors) - 1;
		$textColorIndex = count($this->textColors) - 1;
		$randBgIndex = rand(0,$backgroundColorIndex);
		$this->imgRes = @imagecreate($this->width, $this->height);
		if (!is_resource($this->imgRes)) {
			return false;
		}
		imagecolorallocate(
			$this->imgRes,
			$this->backgroundColors[$randBgIndex][0],
			$this->backgroundColors[$randBgIndex][1],
			$this->backgroundColors[$randBgIndex][2]
		);
		if ($this->useGrid == true) {
			$gridColor = imagecolorallocate($this->imgRes,$this->gridColor[0],$this->gridColor[1],$this->gridColor[2]);
			$i=0;
			while ($i<$this->height) {
				imageline($this->imgRes, 0, $i, $this->width, $i, $gridColor);
				$i += $this->gridSize;
			}
			$i=0;
			while ($i<$this->width) {
				imageline($this->imgRes, $i, 0, $i, $this->height, $gridColor);
				$i += $this->gridSize;
			}
		}
		for ($i=0; $i<count($this->charArr); $i++) {
			$xPos = $this->paddingLeft + $this->length[$i];
			$randColorIndex = rand(0,$textColorIndex);
			imagettftext(
				$this->imgRes,
				$this->charArr[$i]['fontsize'],
				$this->charArr[$i]['angle'],
				$xPos,
				$minHeight+rand($this->randYOrdinate[0],$this->randYOrdinate[1]),
				imagecolorallocate(
					$this->imgRes,
					$this->textColors[$randColorIndex][0],
					$this->textColors[$randColorIndex][1],
					$this->textColors[$randColorIndex][2]
				),
				$this->charArr[$i]['fontfile'],
				$this->charArr[$i]['char']
			);
		}
		return true;
	}

	function getTextLength() {
		$this->length = array();
		$len = 0;
		$this->length[] = $len;
		for ($i=0; $i<count($this->textArr); $i++) {
			$charX1 = abs($this->textArr[$i][4] - $this->textArr[$i][0]);
			$charX2 = abs($this->textArr[$i][2] - $this->textArr[$i][6]);
			$charWidth = ($charX2 > $charX1) ? $charX2 : $charX1;
			$charWidth = (int) ($this->letterSpacingX * $charWidth);
			$len += $charWidth;
			$this->length[] = $len;
		}
		return $len;
	}

	function getTextHeight() {
		$charHeight = 0;
		for ($i=0; $i<count($this->textArr); $i++) {
			$charY1 = abs($this->textArr[$i][5] - $this->textArr[$i][1]);
			$charY2 = abs($this->textArr[$i][7] - $this->textArr[$i][3]);
			if ($charY1 > $charHeight) {
				$charHeight = $charY1;
			}
			if ($charY2 > $charHeight) {
				$charHeight = $charY2;
			}
		}
		return $charHeight;
	}

}

?>
