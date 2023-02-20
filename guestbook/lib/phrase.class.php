<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.4.3 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class Phrase {

	var $allowedChars;
	var $minLength;
	var $maxLength;

	function Phrase() {
		$this->allowedChars = array(
			"a","b","c","d","e","f","g","h","i","j","k","l","m",
			"n","o","p","q","r","s","t","u","v","w","x","y","z",
			"A","B","C","D","E","F","G","H","I","J","K","L","M",
			"N","O","P","Q","R","S","T","U","V","W","X","Y","Z"
		);
		$this->minLength = 5;
		$this->maxLength = 5;
	}

	function setStringLengthRange($minLength, $maxLength) {
		$minLength = (int) ($minLength);
		$maxLength = (int) ($maxLength);
		if ($maxLength >= $minLength) {
			$this->setMinStringLength($minLength);
			$this->setMaxStringLength($maxLength);
			return true;
		}
		return false;
	}

	function setStringLength($len) {
		$len = (int) ($len);
		if ($len > 0) {
			$this->setStringLengthRange($len, $len);
			return true;
		}
		return false;
	}

	function setMinStringLength($len) {
		$len = (int) ($len);
		if ($len > 0) {
			$this->minLength = $len;
			return true;
		}
		return false;
	}

	function setMaxStringLength($len) {
		$len = (int) ($len);
		if ($len > 0) {
			$this->maxLength = $len;
			return true;
		}
		return false;
	}

	function getPhrase() {
		$phrase = "";
		$maxCharIndex = count($this->allowedChars) - 1;
		srand((double)microtime()*1000000);
		if ($this->maxLength < $this->minLength) {
			$strLenght = $this->minLength;
			$this->maxLength = $this->minLength;
		} else {
			$strLenght = rand($this->minLength, $this->maxLength);
		}
		for($i=0; $i<$strLenght; $i++) {
			$randIndex = rand(0,$maxCharIndex);
			$phrase .= strval($this->allowedChars[$randIndex]);
		}
		return $phrase;
	}

}

?>
