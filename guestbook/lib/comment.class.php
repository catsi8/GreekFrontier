<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.4.3 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class gb_comment {

    var $comment;
    var $ip;
    var $id;
    var $db;
    var $user;
    var $pass_comment;
    var $template;
    var $path;
    var $gb_captcha = '';

    function gb_comment($path='') {
        global $_SERVER;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->db = new guestbook_vars($path);
        $this->db->getVars();
        $this->path = $path;
        $this->template = &$this->db->template;
        $this->canUseCaptcha = (USE_CAPTCHA) ? true : false;
        $this->token = '';
    }

    function is_valid_id() {
        $this->db->query("select id from ".$this->db->table['data']." WHERE (id = '".intval($this->id)."')");
        $this->db->fetch_array($this->db->result);
        return ($this->db->record) ? true : false;
    }

    function comment_form() {
        global $GB_UPLOAD, $GB_PG;
        $this->db->query("select x.*, y.p_filename, y.width, y.height from ".$this->db->table['data']." x left join ".$this->db->table['pics']." y on (x.id=y.msg_id and y.book_id=2) WHERE (id = '".intval($this->id)."')");
        $row = $this->db->fetch_array($this->db->result);
        $LANG = &$this->db->LANG;
        $VARS = &$this->db->VARS;
        $DATE = $this->db->DateFormat($row['date']);
        $MESSAGE = nl2br($row['comment']);
        $id = $this->id;
        $bgcolor = $this->db->VARS['tb_color_1'];
        $COMMENT ='';
        $row['email2'] = str_replace("@", "(at)", $row['email']);
        if ($this->canUseCaptcha) {
        	$VARS['gbtoken'] = $this->getToken();
        	eval("\$CAPTCHA = \"".$this->template->get_template($this->db->GB_TPL['captcha'])."\";");
        } else {
        	$VARS['gbtoken'] = "";
        	$CAPTCHA = "";
        }
        if ($row['p_filename'] && ereg("^img-",$row['p_filename'])) {
            $img = new gb_image();
            $img->set_border_size($this->db->VARS["img_width"], $this->db->VARS["img_height"]);
            $new_img_size = $img->get_img_size_format($row['width'], $row['height']);
            if (file_exists("$this->path/$GB_UPLOAD/t_$row[p_filename]")) {
                $row['p_filename'] = "t_$row[p_filename]";
            }
            eval("\$USER_PIC = \"".$this->template->get_template($this->db->GB_TPL['image'])."\";");
        } else {
            $USER_PIC = '';
        }
        if ($this->db->VARS["smilies"] == 1) {
            $MESSAGE = $this->db->emotion($MESSAGE);
        }
        if (!$row['location']) {
            $row['location'] = "-";
        }
        if ($row['url']) {
            eval("\$URL = \"".$this->template->get_template($this->db->GB_TPL['url'])."\";");
        } else {
            $URL = '';
        }
        if ($row['icq'] && $this->db->VARS["allow_icq"]==1) {
            eval("\$ICQ = \"".$this->template->get_template($this->db->GB_TPL['icq'])."\";");
        } else {
            $ICQ = '';
        }
        if ($row['aim'] && $this->db->VARS["allow_aim"]==1) {
            eval("\$AIM = \"".$this->template->get_template($this->db->GB_TPL['aim'])."\";");
        } else {
            $AIM = '';
        }
        if ($row['email']) {
            $row['email'] = "javascript:getEmail('".$this->db->encryptEmail("mailto:".$row['email'])."')";
            eval("\$EMAIL = \"".$this->template->get_template($this->db->GB_TPL['email'])."\";");
        } else {
            $EMAIL = '';
        }
        if ($this->db->VARS["allow_gender"]==1) {
            $GENDER = ($row['gender']=="f") ? "&nbsp;<img src=\"$GB_PG[base_url]/img/female.gif\" width=\"12\" height=\"12\">" : "&nbsp;<img src=\"$GB_PG[base_url]/img/male.gif\" width=\"12\" height=\"12\">";
        } else {
            $GENDER = '';
        }
        if ($this->db->VARS["show_ip"] == 1) {
            $hostname = ( eregi("^[-a-z_]+", $row['host']) ) ? "Host" : "IP";
            $HOST = "$hostname: $row[host]\n";
        } else {
            $HOST='';
        }
        if ($this->db->VARS["need_pass"]==1) {
            eval("\$COMMENT_PASS = \"".$this->template->get_template($this->db->GB_TPL['com_pass'])."\";");
        } else {
            $COMMENT_PASS = '';
        }
        $GB_COMMENT = "#";
        $GB_ENTRY = "";
        $comment_html = "";
        eval("\$GB_ENTRY = \"".$this->template->get_template($this->db->GB_TPL['entry'])."\";");
        eval("\$comment_html = \"".$this->template->get_template($this->db->GB_TPL['header'])."\";");
        eval("\$comment_html .= \"".$this->template->get_template($this->db->GB_TPL['com_form'])."\";");
        eval("\$comment_html .= \"".$this->template->get_template($this->db->GB_TPL['footer'])."\";");
        return $comment_html;
    }

    function check_comment() {
        $this->comment = $this->db->FormatString($this->comment);
        if (empty($this->comment)) {
            return $this->db->gb_error($this->db->LANG["ErrorPost11"]);
        }
        $this->user = $this->db->FormatString($this->user);
        if (empty($this->user)) {
            return $this->db->gb_error($this->db->LANG["ErrorPost1"]);
        }
        if (!$this->db->CheckWordLength($this->user)) {
            return $this->db->gb_error($this->db->LANG["ErrorPost4"]);
        }
        if (!$this->db->CheckWordLength($this->comment)) {
            return $this->db->gb_error($this->db->LANG["ErrorPost10"]);
        }
        if ($this->db->VARS["allow_html"]==0) {
            $this->comment = htmlspecialchars($this->comment);
        }
        if ($this->db->VARS["agcode"]==1) {
            $this->comment = $this->db->AGCode($this->comment);
        }
        if (!get_magic_quotes_gpc()) {
            $this->user = addslashes($this->user);
            $this->comment = addslashes($this->comment);
        }
        $this->user = htmlspecialchars($this->user);
        if ($this->db->VARS["need_pass"]==1) {
            if (get_magic_quotes_gpc()) {
                $this->pass_comment = stripslashes($this->pass_comment);
            }
            if ($this->db->VARS["comment_pass"] != "$this->pass_comment") {
                return $this->db->gb_error($this->db->LANG["PassMess3"]);
            }
        }
        if ($this->db->VARS["censor"]==1) {
            $this->user = $this->db->CensorBadWords($this->user);
            $this->comment = $this->db->CensorBadWords($this->comment);
        }
        if ($this->db->VARS["flood_check"]==1) {
            if ($this->db->FloodCheck($this->ip)) {
               return $this->db->gb_error($this->db->LANG["ErrorPost8"]);
            }
        }
        if ($this->db->VARS["banned_ip"]==1) {
            if ($this->db->isBannedIp($this->ip)) {
                return $this->db->gb_error($this->db->LANG["ErrorPost9"]);
            }
        }
        if ($this->canUseCaptcha) {
        	if ($this->token == '' || $this->gb_captcha == '') {
        		return $this->db->gb_error($this->db->LANG["ErrorPost4"]);
        	}
        	if (get_magic_quotes_gpc()) {
        		$this->gb_captcha = stripslashes($this->gb_captcha);
        	}
        	$gb_captcha = strtoupper($this->gb_captcha);

        	$res = $this->db->query("SELECT validate_key FROM {$this->db->table['cap']} WHERE session_id = '".addslashes($this->token)."'");
        	$result = $this->db->fetch_array($res);
        	if ($result == false || $result['validate_key'] == "" || $gb_captcha == "") {
        		return $this->db->gb_error($this->db->LANG["ErrorPost4"]);
        	}

        	$result['validate_key'] = strtoupper($result['validate_key']);
        	if ($result['validate_key'] != $gb_captcha) {
        		return $this->db->gb_error($this->db->LANG["ErrorPost4"]);
        	}
    	}
        return 1;
    }

	function getToken() {
		srand((double)microtime()*1000000);
		$token = md5(uniqid(rand()));
		$phraseObj = new Phrase();
		$phraseObj->setStringLengthRange(5,7);
		$validateKey = $phraseObj->getPhrase();
		$timestamp = time();
		$this->db->query("INSERT INTO {$this->db->table['cap']} SET session_id='$token', validate_key='$validateKey', timestamp='$timestamp'");
		return $token;
	}

    function insert_comment() {
        $the_time = time();
        $host = @gethostbyaddr($this->ip);
        $this->db->query("INSERT INTO ".$this->db->table['com']." (id,name,comments,host,timestamp) VALUES ('$this->id','$this->user','$this->comment','$host','$the_time')");
        if ($this->canUseCaptcha) {
        	$this->db->query("DELETE FROM {$this->db->table['cap']} WHERE session_id = '".addslashes($this->token)."'");
    	}
    }

    function comment_action($action='') {
        global $GB_PG;
        if ($this->id && $this->is_valid_id() && $action==1) {
            $status = $this->check_comment();
            if ($status == 1) {
                $this->insert_comment();
                header("Location: $GB_PG[index]");
            } else {
                echo $status;
            }
        } elseif ($this->id && $this->is_valid_id()) {
            echo $this->comment_form();
        } else {
            header("Location: $GB_PG[index]");
        }
    }

}

?>
