<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.4.3 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class gb_template {

    var $template = array();
    var $root_dir;
    var $LANG;
    var $plain_html = array();
    var $illegalChars = array(
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

    function gb_template($path='') {
        if ($path != "" && is_dir($path)) {
        	$this->root_dir = $path;
        } else {
        	$this->root_dir = dirname(dirname(__FILE__));
    	}
    }

    function set_rootdir($tpl_dir) {
        if (!is_dir($tpl_dir)) {
            return false;
        }
        $this->root_dir = $tpl_dir;
        return true;
    }

    function set_lang($language='') {
    	$language = trim(strtr($language, $this->illegalChars));
    	$language = str_replace("codes-", "", $language);
        if (!empty($language) && is_file("$this->root_dir/lang/$language.php")) {
            $this->language = $language;
        } else {
            $this->language = "english";
        }
        return $this->language;
    }

    function get_content() {
        if (!isset($this->LANG)) {
            if (is_file("$this->root_dir/lang/".$this->language.".php")) {
            	include "$this->root_dir/lang/".$this->language.".php";
            }
            $this->LANG = &$LANG;
            $this->WEEKDAY = &$weekday;
            $this->MONTHS = &$months;
        }
        return $this->LANG;
    }

    function get_template($tpl) {
        if (!isset($this->template[$tpl])) {
            $filename = "$this->root_dir/templates/$tpl";
            if (is_file("$filename") && filesize("$filename")>0) {
                $fd = fopen ($filename, "r");
                $this->template[$tpl] = fread ($fd, filesize ($filename));
                fclose ($fd);
                $this->template[$tpl] = ereg_replace("\"", "\\\"", $this->template[$tpl]);
            } else {
        		 $this->template[$tpl] = "";
        	}
        }
        return $this->template[$tpl];
    }

}

?>
