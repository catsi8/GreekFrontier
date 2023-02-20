<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.4.3 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class addentry {

    var $db;
    var $ip;
    var $include_path;
    var $template;
    var $name = '';
    var $email = '';
    var $url = '';
    var $comment = '';
    var $location = '';
    var $icq = '';
    var $aim = '';
    var $gender = '';
    var $userfile = '';
    var $user_img = '';
    var $preview = '';
    var $private = '';
    var $token = '';
    var $gb_captcha = '';
    var $image_file = '';
    var $image_tag = '';
    var $GB_TPL = array();
    var $table = array();
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

    function addentry($path='') {
        global $GB_TPL, $GB_TBL, $_SERVER;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->db = new guestbook_vars($path);
        $this->db->getVars();
        $this->template = &$this->db->template;
        $this->include_path = $path;
        $this->GB_TPL = &$GB_TPL;
        $this->table = &$GB_TBL;
        $this->token = '';
        $this->canUseCaptcha = (USE_CAPTCHA) ? true : false;
    }

    function undo_htmlspecialchars($string) {
        $html = array (
            "&amp;"  => "&",
            "&quot;" => "\"",
            "&lt;"   => "<",
            "&gt;"   => ">"
        );
        for(reset($html); $key=key($html); next($html)) {
            $string = str_replace("$key","$html[$key]",$string);
        }
        return ($string);
    }

    function clear_tmpfiles($cachetime=1800) {
        global $GB_TMP;
        $delfiles = 0;
        $filelist = '';
        if (is_dir("$this->include_path/$GB_TMP")) {
            chdir("$this->include_path/$GB_TMP");
            $hnd = opendir(".");
            while ($file = readdir($hnd)) {
                if(is_file($file)) {
                    $filelist[] = $file;
                }
            }
            closedir($hnd);
        }
        if (is_array($filelist)) {
            while (list ($key, $file) = each ($filelist)) {
                $tmpfile = explode(".",$file);
                $tmpfile[0] = ereg_replace ("img-", "", $tmpfile[0]);
                if ($tmpfile[0] < (time()-$cachetime)) {
                    if (unlink($file)) {
                        $delfiles ++;
                    }
                }
            }
        }
        return $delfiles;
    }

    function is_uploaded_file_readable($uploaded_file_tmp_name) {
        $check = @fopen($uploaded_file_tmp_name, "rb");
        if ($check) {
            fclose($check);
            return 1;
        } else {
            $is_safe_mode = get_cfg_var("safe_mode");
            if ($is_safe_mode) {
                return -1;
            } else {
                return 2;
            }
        }
    }

	function getToken() {
		srand((double)microtime()*1000000);
		$token = md5(uniqid(rand()));
		$phraseObj = new Phrase();
		$phraseObj->setStringLengthRange(5,7);
		$validateKey = $phraseObj->getPhrase();
		$timestamp = time();
		$this->db->query("INSERT INTO {$this->table['cap']} SET session_id='$token', validate_key='$validateKey', timestamp='$timestamp'");
		return $token;
	}

	function getLanguageFile($language) {
		$language = trim(strtr($language, $this->illegalChars));
    	$language = str_replace("codes-", "", $language);
    	if (!empty($language) && is_file("$this->include_path/lang/$language.php")) {
            return $language;
        } else {
            return "english";
        }
	}

    function check_entry($type='') {
        global $GB_UPLOAD, $GB_TMP, $GB_PG;
        $this->db->VARS["max_img_size"] = $this->db->VARS["max_img_size"]*1024;
        if ($this->db->VARS["banned_ip"]==1) {
            if ($this->db->isBannedIp($this->ip)) {
                 return $this->db->gb_error($this->db->LANG["ErrorPost9"]);
            }
        }
        if ($this->db->VARS["flood_check"]==1) {
            if ($this->db->FloodCheck($this->ip)) {
                return $this->db->gb_error($this->db->LANG["ErrorPost8"]);
            }
        }
        if (is_array($this->userfile) && $this->userfile["userfile"]["tmp_name"] != "none" && (filesize($this->userfile["userfile"]["tmp_name"])>0)) {
            $uploaded_img_file_stat = $this->is_uploaded_file_readable($this->userfile["userfile"]["tmp_name"]);
        } else {
            $uploaded_img_file_stat = -1;
        }
        if ($uploaded_img_file_stat > 0) {
            $extension = array("1" => 'gif',"2" => 'jpg',"3" => 'png',"4" => 'swf');
            $the_time = time();
            if ($this->userfile["userfile"]["size"] > $this->db->VARS["max_img_size"]) {
                return $this->db->gb_error($this->db->LANG["ErrorPost6"]);
            } else {
                if ($uploaded_img_file_stat == 1) {
                    $size = @GetImageSize($this->userfile["userfile"]["tmp_name"]);
                    $open_basedir_res = false;
                } else {
                    $open_basedir_res = true;
                    if (!eregi("WIN",PHP_OS)) {
                        exec("cp ".$this->userfile["userfile"]["tmp_name"]." $this->include_path/$GB_TMP/img-$the_time.tmp");
                    } else {
                        $win_command = str_replace("/","\\",$this->userfile["userfile"]["tmp_name"]);
                        $win_loc = str_replace("/","\\", "$this->include_path/$GB_TMP/img-$the_time.tmp");
                        exec("copy $win_command $win_loc");
                    }
                    $size = @GetImageSize("$this->include_path/$GB_TMP/img-$the_time.tmp");
                }
                if (is_array($size) && $size[2]>0 && $size[2]<4) {
                    $this->image_file = "img-$the_time.".$extension[$size[2]];
                    $img = new gb_image();
                    $img->set_destdir("$this->include_path/$GB_UPLOAD");
                    $img->set_border_size($this->db->VARS["img_width"], $this->db->VARS["img_height"]);
                    if ($type=="preview") {
                        if (!$open_basedir_res) {
                            move_uploaded_file($this->userfile["userfile"]["tmp_name"], "$this->include_path/$GB_TMP/$this->image_file");
                        } else {
                            rename("$this->include_path/$GB_TMP/img-$the_time.tmp", "$this->include_path/$GB_TMP/$this->image_file");
                        }
                        $new_img_size = $img->get_img_size_format($size[0], $size[1]);
                        $GB_UPLOAD = $GB_TMP;
                        $row['p_filename'] = $this->image_file;
                        $row['width'] = $size[0];
                        $row['height'] = $size[1];
                        eval("\$this->tmp_image = \"".$this->template->get_template($this->GB_TPL['image'])."\";");
                    } else {
                        if (!$open_basedir_res) {
                            move_uploaded_file($this->userfile["userfile"]["tmp_name"], "$this->include_path/$GB_UPLOAD/$this->image_file");
                        } else {
                            rename("$this->include_path/$GB_TMP/img-$the_time.tmp", "$this->include_path/$GB_UPLOAD/$this->image_file");
                        }
                        if ($this->db->VARS["thumbnail"]==1) {
                            $min_size = 1024*$this->db->VARS["thumb_min_fsize"];
                            $img->set_min_filesize($min_size);
                            $img->set_prefix("t_");
                            $img->create_thumbnail("$this->include_path/$GB_UPLOAD/$this->image_file","$this->image_file");
                        }
                    }
                } else {
                    return $this->db->gb_error($this->db->LANG["ErrorPost7"]);
                }
            }
        }
        if (!empty($this->user_img)) {
            $this->image_file = trim($this->user_img);
        }
        $this->name = $this->db->FormatString($this->name);
        $this->location = $this->db->FormatString($this->location);
        $this->comment = $this->db->FormatString($this->comment);
        $this->icq = intval($this->db->FormatString($this->icq));
        $this->aim = htmlspecialchars($this->db->FormatString($this->aim));
        if ($this->icq < 1000 || $this->icq >999999999) {
            $this->icq = 0;
        }
        if ($this->name == "") {
            return $this->db->gb_error($this->db->LANG["ErrorPost1"]);
        } elseif (strlen($this->comment)<$this->db->VARS["min_text"] || strlen($this->comment)>$this->db->VARS["max_text"]) {
            return $this->db->gb_error($this->db->LANG["ErrorPost3"]);
        } else {
            $this->url = trim($this->url);
            $this->email = trim($this->email);
            if (!eregi("^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\\.)+[a-z]{2,5}$", $this->email) ) {
                $this->email = '';
            }
            if (!eregi("^http://[_a-z0-9-]+\\.[_a-z0-9-]+", $this->url)) {
                $this->url = '';
            }
            if (htmlspecialchars($this->url) != "$this->url") {
                $this->url = '';
            }
        }
        if ($this->db->VARS["censor"]==1) {
            $this->name = $this->db->CensorBadWords($this->name);
            $this->location = $this->db->CensorBadWords($this->location);
            $this->comment = $this->db->CensorBadWords($this->comment);
        }
        if (!$this->db->CheckWordLength($this->name) || !$this->db->CheckWordLength($this->location)) {
            return $this->db->gb_error($this->db->LANG["ErrorPost4"]);
        }
        if (!$this->db->CheckWordLength($this->comment)) {
            return $this->db->gb_error($this->db->LANG["ErrorPost10"]);
        }
        if ($this->canUseCaptcha) {
        	if ($this->token == '' || $this->gb_captcha == '') {
        		return $this->db->gb_error($this->db->LANG["ErrorPost4"]);
        	}
        	if (get_magic_quotes_gpc()) {
        		$this->gb_captcha = stripslashes($this->gb_captcha);
        	}
        	$gb_captcha = strtoupper($this->gb_captcha);

        	$res = $this->db->query("SELECT validate_key FROM {$this->table['cap']} WHERE session_id = '".addslashes($this->token)."'");
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

    function add_guest() {
        global $GB_TMP, $GB_UPLOAD, $GB_PG;
        if ($this->preview==1 && $this->user_img) {
            $img = new gb_image();
            $img->set_destdir("$this->include_path/$GB_UPLOAD");
            $img->set_border_size($this->db->VARS["img_width"], $this->db->VARS["img_height"]);
            if ($this->db->VARS["thumbnail"]==1) {
                $min_size = 1024*$this->db->VARS["thumb_min_fsize"];
                $img->set_min_filesize($min_size);
                $img->set_prefix("t_");
                $img->create_thumbnail("$this->include_path/$GB_TMP/$this->user_img",$this->user_img);
            }
            copy("$this->include_path/$GB_TMP/$this->user_img", "$this->include_path/$GB_UPLOAD/$this->user_img");
            unlink("$this->include_path/$GB_TMP/$this->user_img");
            $this->image_file = $this->user_img;
        }
        $this->name = htmlspecialchars($this->name);
        $this->location = htmlspecialchars($this->location);
        if ($this->db->VARS["allow_html"] == 0) {
            $this->comment = htmlspecialchars($this->comment);
        }
        if ($this->db->VARS["agcode"] == 1) {
            $this->comment = $this->db->AGCode($this->comment);
        }
        if (!get_magic_quotes_gpc()) {
            $this->name = addslashes($this->name);
            $this->location = addslashes($this->location);
            $this->aim = addslashes($this->aim);
            $this->email = addslashes($this->email);
            $this->url = addslashes($this->url);
            $this->comment = addslashes($this->comment);
            $this->gender = addslashes($this->gender);
        }
        $host = addslashes(@gethostbyaddr($this->ip));
        $agent = addslashes(htmlspecialchars(strip_tags($_SERVER['HTTP_USER_AGENT'])));
        $the_time = time();
        $sql_usertable = ($this->private==1) ? $this->table['priv'] : $this->table['data'];
        $this->db->query("INSERT INTO $sql_usertable (name,gender,email,url,date,location,host,browser,comment,icq,aim) VALUES ('$this->name','$this->gender','$this->email','$this->url','$the_time','$this->location','$host','$agent','$this->comment','$this->icq','$this->aim')");
        if ($this->canUseCaptcha) {
        	$this->db->query("DELETE FROM {$this->table['cap']} WHERE session_id = '".addslashes($this->token)."'");
    	}
        if (!empty($this->image_file) || !empty($this->user_img)) {
            $size = GetImageSize("$this->include_path/$GB_UPLOAD/$this->image_file");
            if (is_array($size) && $size[2]>0 && $size[2]<4) {
                $book_id = ($this->private==1) ? 1 : 2;
                $p_filesize = filesize("$this->include_path/$GB_UPLOAD/$this->image_file");
                $this->db->fetch_array($this->db->query("SELECT MAX(id) AS msg_id FROM $sql_usertable"));
                $this->db->query("INSERT INTO ".$this->table['pics']." (msg_id,book_id,p_filename,p_size,width,height) VALUES ('".$this->db->record['msg_id']."',$book_id,'$this->image_file','$p_filesize','$size[0]','$size[1]')");
            }
        }
        $from_email = ($this->email == "") ? $this->db->VARS['admin_mail'] : $this->email;
        if ($this->db->VARS["notify_private"]==1 && $this->private==1) {
            @mail($this->db->VARS["admin_mail"],$this->db->LANG["EmailAdminSubject"],"$this->name\n$this->host\n\n$this->comment", "From: $from_email\nX-Mailer: Advanced Guestbook 2");
        }
        if ($this->db->VARS["notify_admin"]==1 && $this->private==0) {
            @mail($this->db->VARS["admin_mail"],$this->db->LANG["EmailAdminSubject"],"$this->name\n$this->host\n\n$this->comment", "From: $from_email\nX-Mailer: Advanced Guestbook 2");
        }
        if ($this->db->VARS["notify_guest"]==1 && $this->email != '') {
            @mail($this->email,$this->db->LANG["EmailGuestSubject"],$this->db->VARS["notify_mes"], "From: ".$this->db->VARS['admin_mail']."\nX-Mailer: Advanced Guestbook 2");
        }
        if ($this->db->VARS["flood_check"]==1) {
            $this->db->query("INSERT INTO ".$this->table['ip']." (guest_ip,timestamp) VALUES ('$this->ip','$the_time')");
        }
        $LANG = &$this->db->LANG;
        $VARS = &$this->db->VARS;
        $success_html = "";
        eval("\$success_html = \"".$this->template->get_template($this->GB_TPL['success'])."\";");
        eval("\$success_html .= \"".$this->template->get_template($this->GB_TPL['footer'])."\";");
        return $success_html;
    }

    function form_addguest() {
        global $GB_PG, $_COOKIE;
        $HTML_CODE = ($this->db->VARS["allow_html"] == 1) ? $this->db->LANG["BookMess2"] : $this->db->LANG["BookMess1"];
        $SMILE_CODE = ($this->db->VARS["smilies"] == 1) ? $this->db->LANG["FormMess2"] : $this->db->LANG["FormMess7"];
        $AG_CODE = ($this->db->VARS["agcode"] == 1) ? $this->db->LANG["FormMess3"] : $this->db->LANG["FormMess6"];
        $LANG = &$this->db->LANG;
        $VARS = &$this->db->VARS;
        if ($this->canUseCaptcha) {
        	$VARS['gbtoken'] = $this->getToken();
        	eval("\$CAPTCHA = \"".$this->template->get_template($this->GB_TPL['captcha'])."\";");
        } else {
        	$VARS['gbtoken'] = "";
        	$CAPTCHA = "";
        }
        $OPTIONS[] ='';
        if ($this->db->VARS["allow_icq"]==1) {
            eval("\$OPTIONS['icq'] = \"".$this->template->get_template($this->GB_TPL['frm_icq'])."\";");
        }
        if ($this->db->VARS["allow_aim"]==1) {
            eval("\$OPTIONS['aim'] = \"".$this->template->get_template($this->GB_TPL['frm_aim'])."\";");
        }
        if ($this->db->VARS["allow_gender"]==1) {
            eval("\$OPTIONS['gender'] = \"".$this->template->get_template($this->GB_TPL['frm_gender'])."\";");
        }
        if ($this->db->VARS["allow_img"]==1) {
            eval("\$OPTIONS['img'] = \"".$this->template->get_template($this->GB_TPL['frm_image'])."\";");
        }
        $OPTIONAL = implode("\n",$OPTIONS);
        if (isset($_COOKIE['lang'])) {
        	$lang = $this->getLanguageFile($_COOKIE['lang']);
           	$LANG_CODES = "$GB_PG[base_url]/lang/codes-".$lang.".php";
        } elseif (file_exists("$this->include_path/lang/codes-".$VARS['lang'].".php")) {
            $LANG_CODES = "$GB_PG[base_url]/lang/codes-".$VARS['lang'].".php";
        } else {
            $LANG_CODES = "$GB_PG[base_url]/lang/codes-english.php";
        }
        $addform_html = "";
        eval("\$addform_html = \"".$this->template->get_template($this->GB_TPL['header'])."\";");
        eval("\$addform_html .= \"".$this->template->get_template($this->GB_TPL['form'])."\";");
        eval("\$addform_html .= \"".$this->template->get_template($this->GB_TPL['footer'])."\";");
        return $addform_html;
    }

    function preview_entry() {
        global $GB_PG;
        if (get_magic_quotes_gpc()) {
            $this->name = stripslashes($this->name);
            $this->comment = stripslashes($this->comment);
            $this->location = stripslashes($this->location);
        }
        $this->name = htmlspecialchars($this->name);
        if ($this->db->VARS["allow_html"] == 0) {
            $message = htmlspecialchars($this->comment);
            $message = nl2br($message);
        } else {
            $message = nl2br($this->comment);
        }
        if ($this->db->VARS["smilies"] == 1) {
            $message = $this->db->emotion($message);
        }
        if ($this->db->VARS["agcode"] == 1) {
            $message = $this->db->AGCode($message);
        }
        $this->location = htmlspecialchars($this->location);
        $this->comment = htmlspecialchars($this->comment);
        $USER_PIC =(isset($this->tmp_image)) ? $this->tmp_image : '';
        $DATE = $this->db->DateFormat(time());
        $host = @gethostbyaddr($this->ip);
        $AGENT = htmlspecialchars($_SERVER['HTTP_USER_AGENT']);
        $LANG = &$this->db->LANG;
        $VARS = &$this->db->VARS;
        if ($this->url) {
            $row['url'] = $this->url;
            eval("\$URL = \"".$this->template->get_template($this->GB_TPL['url'])."\";");
        } else {
            $URL = '';
        }
        if ($this->icq && $this->db->VARS["allow_icq"]==1) {
            $row['icq'] = $this->icq;
            eval("\$ICQ = \"".$this->template->get_template($this->GB_TPL['icq'])."\";");
        } else {
            $ICQ = '';
        }
        if ($this->aim && $this->db->VARS["allow_aim"]==1) {
            $row['aim'] = $this->aim;
            eval("\$AIM = \"".$this->template->get_template($this->GB_TPL['aim'])."\";");
        } else {
            $AIM = '';
        }
        if ($this->email) {
            $row['email'] = $this->email;
            eval("\$EMAIL = \"".$this->template->get_template($this->GB_TPL['email'])."\";");
        } else {
            $EMAIL = '';
        }
        if ($this->db->VARS["allow_gender"]==1) {
            $GENDER = ($this->gender=="f") ? "&nbsp;<img src=\"$GB_PG[base_url]/img/female.gif\" width=\"12\" height=\"12\">" : "&nbsp;<img src=\"$GB_PG[base_url]/img/male.gif\" width=\"12\" height=\"12\">";
        } else {
            $GENDER = '';
        }
        if ($this->db->VARS["show_ip"] == 1) {
            $hostname = ( eregi("^[-a-z_]+", $host) ) ? "Host" : "IP";
            $HOST = "$hostname: $host\n";
        } else {
            $HOST = '';
        }
        $HIDDEN = "<input type=\"hidden\" name=\"gb_preview\" value=\"1\">\n";
        $HIDDEN .= "<input type=\"hidden\" name=\"gb_name\" value=\"".$this->name."\">\n";
        $HIDDEN .= "<input type=\"hidden\" name=\"gb_email\" value=\"".$this->email."\">\n";
        $HIDDEN .= "<input type=\"hidden\" name=\"gb_url\" value=\"".$this->url."\">\n";
        $HIDDEN .= "<input type=\"hidden\" name=\"gb_comment\" value=\"".$this->comment."\">\n";
        $HIDDEN .= "<input type=\"hidden\" name=\"gb_location\" value=\"".$this->location."\">\n";
        if ($this->image_file) {
            $HIDDEN .= "<input type=\"hidden\" name=\"gb_user_img\" value=\"".$this->image_file."\">\n";
        }
        if ($this->private==1) {
            $HIDDEN .= "<input type=\"hidden\" name=\"gb_private\" value=\"".$this->private."\">\n";
        }
        if ($this->db->VARS["allow_gender"]==1) {
            $HIDDEN .= "<input type=\"hidden\" name=\"gb_gender\" value=\"".$this->gender."\">\n";
        }
        if ($this->icq && $this->db->VARS["allow_icq"]==1) {
            $HIDDEN .= "<input type=\"hidden\" name=\"gb_icq\" value=\"".$this->icq."\">\n";
        }
        if ($this->aim && $this->db->VARS["allow_aim"]==1) {
            $HIDDEN .= "<input type=\"hidden\" name=\"gb_aim\" value=\"".$this->aim."\">\n";
        }
        $HIDDEN .= "<input type=\"hidden\" name=\"gb_token\" value=\"".$this->token."\">\n";
        $row['name'] = $this->name;
        $row['location'] = $this->location;
        $row['email'] = $this->email;
        $GB_PREVIEW = "";
        $preview_html = "";
        if ($this->canUseCaptcha) {
        	$VARS['gbtoken'] = $this->token;
        	eval("\$CAPTCHA = \"".$this->template->get_template($this->GB_TPL['captcha'])."\";");
        } else {
        	$VARS['gbtoken'] = "";
        	$CAPTCHA = "";
        }
        eval("\$GB_PREVIEW = \"".$this->template->get_template($this->GB_TPL['prev_entry'])."\";");
        eval("\$preview_html = \"".$this->template->get_template($this->GB_TPL['header'])."\";");
        eval("\$preview_html .= \"".$this->template->get_template($this->GB_TPL['preview'])."\";");
        eval("\$preview_html .= \"".$this->template->get_template($this->GB_TPL['footer'])."\";");
        return $preview_html;
    }

    function process($action='') {
        switch ($action) {
            case $this->db->LANG["FormSubmit"]:
                if ($this->preview==1) {
                    $this->comment = $this->undo_htmlspecialchars($this->comment);
                    $this->name = $this->undo_htmlspecialchars($this->name);
                }
                $this->clear_tmpfiles();
                $status = $this->check_entry();
                return ($status == 1) ? $this->add_guest() : $status;
                break;

            case $this->db->LANG["FormPreview"]:
                $status = $this->check_entry("preview");
                return ($status == 1) ? $this->preview_entry() : $status;
                break;

            default:
                return $this->form_addguest();
        }
    }

}

?>
