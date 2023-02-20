<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.4.3 (PHP/MySQL)
 * Copyright (c) Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class guestbook {

    var $total;
    var $db;
    var $template;
    var $path;

    function guestbook($path='') {
        $this->db = new guestbook_vars($path);
        $this->db->getVars();
        $this->total = 0;
        $this->path = $path;
        $this->template = &$this->db->template;
    }

    function get_nav($entry=0) {
        global $_SERVER, $GB_PG;
        $entry = intval($entry);
        $self = (IS_MODULE && eregi("\?",$GB_PG["index"])) ? "$GB_PG[index]&entry=" : basename($_SERVER['PHP_SELF'])."?entry=";
        $next_page = $entry+$this->db->VARS['entries_per_page'];
        $prev_page = $entry-$this->db->VARS['entries_per_page'];
        $navigation = '';
        if ($prev_page >= 0) {
            $navigation = "   <img src=\"$GB_PG[base_url]/img/back.gif\" width=\"16\" height=\"14\"><a href=\"$self$prev_page\">".$this->db->LANG["NavPrev"]."</a>\n";
        }
        if ($next_page < $this->total) {
            $navigation = $navigation."   &nbsp;&nbsp;<a href=\"$self$next_page\">".$this->db->LANG["NavNext"]."</a><img src=\"$GB_PG[base_url]/img/next.gif\" width=\"16\" height=\"14\">\n";
        }
        return $navigation;
    }

    function show_entries($entry=0) {
        global $GB_PG;
        $entry = intval($entry);
        $LANG = &$this->db->LANG;
        $VARS = &$this->db->VARS;
        $this->db->fetch_array($this->db->query("select count(*) as total from ".$this->db->table['data']));
        $this->total = $this->db->record["total"];
        $TPL = $this->get_entries($entry,$this->db->VARS["entries_per_page"]);
        $TPL['GB_TOTAL'] = $this->total;
        $TPL['GB_JUMPMENU'] = implode("\n",$this->generate_JumpMenu());
        $TPL['GB_TIME'] = $this->db->DateFormat(time());
        $TPL['GB_NAVIGATION'] = $this->get_nav($entry);
        $TPL['GB_HTML_CODE'] = ($this->db->VARS["allow_html"] == 1) ? $this->db->LANG["BookMess2"] : $this->db->LANG["BookMess1"];
        $guestbook_html = "";
        eval("\$guestbook_html = \"".$this->template->get_template($this->db->GB_TPL['header'])."\";");
        eval("\$guestbook_html .= \"".$this->template->get_template($this->db->GB_TPL['body'])."\";");
        eval("\$guestbook_html .= \"".$this->template->get_template($this->db->GB_TPL['footer'])."\";");
        return $guestbook_html;
    }

    function generate_JumpMenu() {
        $menu_array[] = "<select name=\"entry\" class=\"select\">";
        $menu_array[] = "<option value=\"0\" selected>".$this->db->LANG["FormSelect"]."</option>";
        if ($this->db->VARS["entries_per_page"] < $this->total) {
            $remain = $this->total % $this->db->VARS["entries_per_page"];
            $i = $this->total-$remain;
            while ($i > 0) {
                $num_max = $i;
                $num_min = $num_max-$this->db->VARS["entries_per_page"];
                $num_min++;
                $menu_array[] = "<option value=\"$remain\">$num_min-$num_max</option>";
                $i = $num_min-1;
                $remain += $this->db->VARS["entries_per_page"];
           }
        }
        $menu_array[] = "</select>";
        $menu_array[] = "<input type=\"submit\" value=\"".$this->db->LANG["FormButton"]."\" class=\"input\">";
        return $menu_array;
    }

    function get_entries($entry,$last_entry) {
        global $GB_UPLOAD, $GB_PG;
        $entry = intval($entry);
        $last_entry = intval($last_entry);
        $img = new gb_image();
        $img->set_border_size($this->db->VARS["img_width"], $this->db->VARS["img_height"]);
        $LANG = &$this->db->LANG;
        $id = $this->total-$entry;
        $HOST = '';
        $COMMENT = '';
        $GB_ENTRIES = '';
        $i=0;
        $template['entry'] = $this->template->get_template($this->db->GB_TPL['entry']);
        $template['com'] = $this->template->get_template($this->db->GB_TPL['com']);
        $template['url'] = $this->template->get_template($this->db->GB_TPL['url']);
        $template['icq'] = $this->template->get_template($this->db->GB_TPL['icq']);
        $template['aim'] = $this->template->get_template($this->db->GB_TPL['aim']);
        $template['email'] = $this->template->get_template($this->db->GB_TPL['email']);
        $template['image'] = $this->template->get_template($this->db->GB_TPL['image']);     
        $result = $this->db->query(
        	"select x.*, y.p_filename, y.width, y.height from 
        	".$this->db->table['data']." x left join ".$this->db->table['pics']." y on (x.id=y.msg_id and y.book_id=2)  
        	order by x.id desc limit $entry, $last_entry"
        );
        while ($row = $this->db->fetch_array($result)) {
            $row['email2'] = "";
            $DATE = $this->db->DateFormat($row['date']);
            $MESSAGE = nl2br($row['comment']);
            if ($row['p_filename'] && ereg("^img-",$row['p_filename'])) {
                if (file_exists("$this->path/$GB_UPLOAD/t_$row[p_filename]")) {
                    $row['p_filename'] = "t_$row[p_filename]";
                }
                $new_img_size = $img->get_img_size_format($row['width'], $row['height']);
                eval("\$USER_PIC = \"".$template['image']."\";");
            } else {
                $USER_PIC = '';
            }
            if ($this->db->VARS["smilies"] == 1) {
                $MESSAGE = $this->db->emotion($MESSAGE);
            }
            if (!$row['location']) {
                $row['location'] = "-";
            }
            $bgcolor = ($i % 2) ? $this->db->VARS["tb_color_2"] : $this->db->VARS["tb_color_1"];
            $i++;
            if ($row['url']) {
                eval("\$URL = \"".$template['url']."\";");
            } else {
                $URL = '';
            }
            if ($row['icq'] && $this->db->VARS["allow_icq"]==1) {
                eval("\$ICQ = \"".$template['icq']."\";");
            } else {
                $ICQ = '';
            }
            if ($row['aim'] && $this->db->VARS["allow_aim"]==1) {
                eval("\$AIM = \"".$template['aim']."\";");
            } else {
                $AIM = '';
            }
            if ($row['email']) {
            	/* E-mail Hack */
                $row['email2'] = str_replace("@", "(at)", $row['email']);
                $row['email2'] = str_replace(".", "(dot)", $row['email2']); 
                $row['email'] = "javascript:getEmail('".$this->db->encryptEmail("mailto:".$row['email'])."')";              
                eval("\$EMAIL = \"".$template['email']."\";");
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
            }
            $this->db->query("select * from ".$this->db->table['com']." where id='$row[id]' order by com_id asc");
			while ($com = $this->db->fetch_array($this->db->result)) {
				$com['comments'] = nl2br($com['comments']);
				eval("\$COMMENT .= \"".$template['com']."\";");
            }          
            $GB_COMMENT = (IS_MODULE && eregi("\?",$GB_PG["comment"])) ? "$GB_PG[comment]&gb_id=$row[id]" : "$GB_PG[comment]?gb_id=$row[id]"; 
            eval("\$GB_ENTRIES .= \"".$template['entry']."\";");
            $COMMENT = "";
            $id--;
        }
        $TPL['GB_ENTRIES'] = $GB_ENTRIES;
        return $TPL;
    }

}

?>
