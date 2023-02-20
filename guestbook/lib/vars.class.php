<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.4.3 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class guestbook_vars extends gbook_sql {

    var $VARS;
    var $LANG;
    var $table = array();
    var $GB_TPL = array();
    var $SMILIES;
    var $template;

    function guestbook_vars($path='') {
        global $GB_TPL,$GB_TBL;
        $this->table = &$GB_TBL;
        $this->GB_TPL = &$GB_TPL;
        $this->gbook_sql();
        $this->connect();
        $this->template = new gb_template($path);
    }

    function getVars() {
        global $_COOKIE;
        $this->VARS = $this->fetch_array($this->query("SELECT * FROM ".$this->table['cfg']));
        $this->free_result($this->result);
        if (isset($_COOKIE['lang']) && !empty($_COOKIE['lang'])) {
            $this->template->set_lang($_COOKIE['lang']);
        } else {
            $this->template->set_lang($this->VARS["lang"]);
        }
        $this->LANG = $this->template->get_content();
        return $this->VARS;
    }

    function emotion($message) {
        global $GB_PG;
        if (!isset($this->SMILIES)) {
            $this->query("SELECT * FROM ".$this->table['smile']);
            while ($this->fetch_array($this->result)) {
                $this->SMILIES[$this->record['s_code']] = "<img src=\"$GB_PG[base_url]/img/smilies/".$this->record['s_filename']."\" width=\"".$this->record['width']."\" height=\"".$this->record['height']."\">";
            }
        }
        if (isset($this->SMILIES)) {
            for(reset($this->SMILIES); $key=key($this->SMILIES); next($this->SMILIES)) {
                $message = str_replace("$key",$this->SMILIES[$key],$message);
            }
        }
        return $message;
    }

    function DateFormat($timestamp) {
        $timestamp += $this->VARS["offset"]*3600;
        list($wday,$mday,$month,$year,$hour,$minutes,$hour12,$ampm) = split("( )",date("w j n Y H i h A",$timestamp));
        if ($this->VARS["tformat"] == "AMPM") {
            $newtime = " $hour12:$minutes $ampm";
        } else {
            $newtime = " $hour:$minutes";
        }
        if ($this->VARS["dformat"] == "USx") {
            $newdate = " $month-$mday-$year";
        } elseif ($this->VARS["dformat"] == "US") {
            $month -= 1;
            $newdate = $this->template->WEEKDAY[$wday].", ".$this->template->MONTHS[$month]." $mday, $year";
        } elseif ($this->VARS["dformat"] == "Euro") {
            $month -= 1;
            $newdate = $this->template->WEEKDAY[$wday].", $mday. ".$this->template->MONTHS[$month]." $year";
        } else {
            $newdate = "$mday.$month.$year";
        }
        return ($newdate=$newdate.$newtime);
    }

    function AGCode($string) {
        $string=eregi_replace("\\[img\\](http://[^\\[]+)\\[/img\\]","<img src=\"\\1\" border=0>",$string);
        $string=eregi_replace("\\[b\\]([^\\[]*)\\[/b\\]","<b>\\1</b>",$string);
        $string=eregi_replace("\\[i\\]([^\\[]*)\\[/i\\]","<i>\\1</i>",$string);
        $string=eregi_replace("\\[email\\]([^\\[]*)\\[/email\\]","<a href=\"mailto:\\1\">\\1</a>",$string);
        $string=eregi_replace("\\[url\\]www.([^\\[]*)\\[/url\\]","<a href=\"http://www.\\1\" target=\"_blank\">\\1</a>",$string);
        $string=eregi_replace("\\[url\\]([^\\[]*)\\[/url\\]","<a href=\"\\1\" target=\"_blank\">\\1</a>",$string);
        $string=eregi_replace("\\[url=http://([^\\[]+)\\]([^\\[]*)\\[/url\\]","<a href=\"http://\\1\" target=\"_blank\">\\2</a>",$string);
        return $string;
    }

    function FormatString($strg) {
        $strg = trim($strg);
        $strg = ereg_replace("[ ]+", " ", $strg);
        return $strg;
    }

    function CheckWordLength($strg) {
        $word_array = split ("[ |\n]",$strg);
        for ($i=0;$i<sizeof($word_array);$i++) {
            if (ereg("^\\[[a-z]{3,5}\\].+\\]",$word_array[$i])) {
                if (strlen($word_array[$i]) > 200) {
                    return false;
                }
            } elseif (strlen($word_array[$i]) > $this->VARS["max_word_len"]) {
                return false;
            }
        }
        return true;
    }

    function isBannedIp($ip) {
        $this->query("SELECT * from ".$this->table['ban']);
        if (!$this->result) {
            return false;
        }
        while ($row = $this->fetch_array($this->result)) {
            if (ereg("^$row[ban_ip]",$ip)) {
                return true;
            }
        }
        return false;
    }

    function FloodCheck($ip) {
        $the_time = time()-$this->VARS["flood_timeout"];
        $this->query("DELETE FROM ".$this->table['ip']." WHERE (timestamp < $the_time)");
        $this->query("SELECT * FROM ".$this->table['ip']." WHERE (guest_ip = '$ip')");
        $this->fetch_array($this->result);
        return ($this->record) ? true : false;
    }

    function CensorBadWords($strg) {
        $replace = "#@*%!";
        $this->query("select * from ".$this->table['words']);
        while ($row = $this->fetch_array($this->result)) {
        	$row['word'] = preg_quote($row['word'], '/');
			$strg = preg_replace('/'.$row['word'].'/i', $replace, $strg);
        }
        return $strg;
    }

    function gb_error($ERROR) {
        global $GB_PG;
        $LANG = &$this->LANG;
        $VARS = &$this->VARS;
        $error_html = "";
        eval("\$error_html .= \"".$this->template->get_template($this->GB_TPL['header'])."\";");
        eval("\$error_html .= \"".$this->template->get_template($this->GB_TPL['error'])."\";");
        eval("\$error_html .= \"".$this->template->get_template($this->GB_TPL['footer'])."\";");
        return $error_html;
    }

	function encryptEmail($email) {
		$email = trim($email);
		$retVal = "";
		if (!empty($email)) {
			for($i=0; $i<strlen($email); $i++) {
				$retVal .= dechex(ord($email[$i]));
			}	
		}
		return $retVal;
	}

}

?>
